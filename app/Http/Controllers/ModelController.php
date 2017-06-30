<?php

namespace App\Http\Controllers;

use App\Facades\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ModelController extends Controller
{
    /**
     * Get model
     *
     * @return object
     */
    public function getModel ($Model, $setDefault = false)
    {
        $Model = ucfirst( strtolower( str_singular( $Model ) ) );

        if (! file_exists( app_path() . "/{$Model}.php" ) ) {

            abort(404);
        }

        $Class = "\\App\\{$Model}";
        $Class = new $Class;

        if ($setDefault) {

            $Class = $this->setDefault($Class);
        }

        return $Class;
    }

    /**
     * Set default configurations
     *
     * @return object
     * */
    private function setDefault ($Class)
    {
        $Default = [
            'title'     =>  ucfirst( strtolower( str_plural( $Class->getTable() ) ) ),
            'hash'      =>  false,
            'access'    =>  ['api', 'form', 'grid'],
            'field'     =>  (object)[],
            'hidden'    =>  []
        ];

        foreach ($Default as $key => $value) {

            if (! isset( $Class->{$key} ) ) {

                $Class->{$key} = $value;
            }
        }

        foreach ($this->tableDetails($Class) as $Field) {

            $Class->field = (object) $Class->field;

            if ( isset( $Class->field ) ) {

                if (! isset( $Class->field->{$Field->name} )) {

                    $Class->field->{$Field->name} = [];
                }
            }

            $Class->field->{$Field->name} = array_merge((array) $Field, $Class->field->{$Field->name} );

            switch ( $Class->field->{$Field->name }['type'] ) {

                case 'pics':

                    /**
                     * Default configurations Uploadfive
                     *
                     * http://www.uploadify.com/documentation/uploadifive/
                     * */
                    $Class->field->{$Field->name} = array_merge([
                        'auto'      =>  'true',
                        'buttonText'=>  'Selecionar arquivos',
                        'max'       =>  10,
                        'path'      =>  '/' . str_singular( $Class->getTable() ) . '/',
                        'sizeLimit' =>  10,
                        'objName'   =>  'file',
                        'multi'     =>  'true',
                        'fileType'  =>  'image/*',
                        'resize'    =>  [ [100, 100], [150, 150] ]
                    ], $Class->field->{$Field->name});
                    break;
            }

            $Class->field->{$Field->name} = (object) $Class->field->{$Field->name};
        }

        return $Class;
    }

    /**
     * Get info table in database
     *
     * @return object
    */
    public function tableDetails ($Model, $Type = 'form')
    {
        $Columns = [];

        foreach ( DB::getDoctrineSchemaManager()->listTableColumns($Model->getTable()) as $Name => $Column) {

            if ( isset( $Model->{$Type}['hidden'] ) && is_array( $Model->{$Type}['hidden'] ) && in_array( $Name, $Model->{$Type}['hidden'] ) ) continue;
            if ( isset( $Model->hidden ) && is_array( $Model->hidden ) && in_array( $Name, $Model->hidden ) ) continue;

            $Name = str_replace('`', '', $Name);

            $Columns[ $Name ] = (object) [
                'label'     =>  ucfirst( strtolower( str_replace('_', ' ', $Name) ) ),
                'name'      =>  $Name,
                'type'		=>	$Column->getType()->getName(),
                'length'	=>	$Column->getLength(),
                'scale'		=>	$Column->getScale(),
                'precision' =>	$Column->getPrecision()
            ];

            if ( is_array($Model->field) ) {

                if ( isset( $Model->field[ $Name ]->label )  ) {

                    $Columns[ $Name ]->label = $Model->field[ $Name ]->label;
                }
            }
        }

        return (object) $Columns;
    }

    /**
     * Get values save in database where @word_group_id
     *
     * @return object
     * */
    public function getValues ($Model)
    {
        $Values = [];
        $ObjValues = $Model;

        if ( in_array('work_group_id', $Model->hidden) ) {

            $ObjValues = $Model->where('work_group_id', Session::get('work_group')->id);
        }

        if ( method_exists( $Model, 'gridCustomWhere' ) ) {

            $ObjValues = $Model->gridCustomWhere($Model);
        }

        foreach ( $ObjValues->orderBy('id', 'DESC')->get() as $Value ) {

            $Values[] = $this->formatData($Value, $Model, 'grid');
        }

        return $Values;
    }

    /**
     * Get value save in database where @word_group_id
     *
     * @return object
     * */
    public function getValue ($Model, $id, $Type = 'form')
    {
        $Model = $this->getModel( str_singular( $Model->getTable() ), true );
        $Value = $Model;

        if ( in_array('work_group_id', $Model->hidden) ) {

            $Value = $Model->where('work_group_id', Session::get('work_group')->id);
        }

        if ( $id == 'form' && method_exists( $Model, 'formCustomWhere' ) ) {
            /* Custom where */
            $Value = $Model->formCustomWhere( $Model );
        } else {
            /* Default */
            $Value->where('id', $id);
        }

        $Value = $Value->first();

        if (! $Value ) {

            $Value = (object)[
              'id'  =>  false
            ];
        }

        $Value = $this->formatData($Value, $Model, $Type);

        return  $Value;
    }

    /**
     * Create form (HTML)
     *
     * @return HTML
     * */
    public function getForm ($Value, $Model)
    {
        $HTML = '';

        if (! $Value->id )
        {
            $Model->hash = hash('crc32b', time() );

            $HTML .= Form::hidden('hash', $Model->hash);
        }

        foreach ($Model->field as $Name => $Field) {

            $Field->value = isset( $Value->{$Name} ) ? $Value->{$Name} : '';

            switch ($Field->type) {

                case 'text':
                    $HTML .= view('form.textarea', compact('Field', 'Model'))->render();
                    break;
                case 'decimal':
                    $HTML .= view('form.decimal', compact('Field', 'Model'))->render();
                    break;
                case 'pics':
                    $HTML .= view('form.pics', compact('Field', 'Model', 'Value'))->render();
                    break;
                default:
                    $HTML .= view('form.input', compact('Field', 'Model'))->render();
                    break;
            }
        }

        return $HTML;
    }

    /**
     * Format data for update database
     * */
    public function formatData ($Value, $Model, $Type = 'form')
    {
        foreach ($Model->field as $Field) {

            if (! isset( $Value->{$Field->name} ) ) continue;

            switch ($Field->type) {

                case 'decimal':

                    $Value->{$Field->name} = number_format( $Value->{$Field->name}, $Field->scale, ',', '.');
                    break;

                case 'pics':

                    if ($Type == 'save') continue;

                    if ($Field->multi != 'false') {

                        $HTML = '';
                        $Path = public_path('img') . "{$Field->path}{$Value->id}/";

                        if (! empty($Value->{$Field->name}) && $Files = scandir( $Path ) ) {

                            $Location = $Value->{$Field->name};
                            $HTML .= view($Type . '.images', compact('Path', 'Field', 'Files', 'Location'))->render();
                        }

                        $Value->{$Field->name} = $HTML;
                    }
                    break;
            }
        }

        return $Value;
    }

    /**
     * Format decimal database format
     *
     * @return @float
     * */
    public function BRLCurrencyToFloat ($number)
    {
        if ($number && !is_numeric($number)) {
            $number = str_replace(',', '.', str_replace('.', '', $number));
        }

        return (float)$number;
    }

    /**
     * Format decimal screen format (ex.: 1,250.00)
     *
     * @return string
     * */
    public function BRLFloatToCurrency ($number, $scale = 2)
    {
        if (is_numeric($number)) {
            $number = number_format($number, $scale);
        }

        return $number;
    }
}