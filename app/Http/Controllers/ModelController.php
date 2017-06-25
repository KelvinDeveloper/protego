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
    private function setDefault($Class)
    {
        $Default = [
            'title' =>  ucfirst( strtolower( str_plural( $Class->getTable() ) ) ),
            'hash'  =>  false,
        ];

        foreach ($Default as $key => $value) {

            if (! isset( $Class->{$key} ) ) {

                $Class->{$key} = $value;
            }
        }

        foreach ($this->tableDetails($Class) as $Field) {

            if (! isset( $Class->field[ $Field->key ] ) ) {

                $Class->field[ $Field->key ] = [];
            }

            $Class->field[ $Field->key ] = array_merge((array) $Field, $Class->field[ $Field->key ]);

            switch ( $Class->field[ $Field->key ]['type'] ) {

                case 'pics':

                    /**
                     * Default configurations Uploadfive
                     *
                     * http://www.uploadify.com/documentation/uploadifive/
                     * */
                    $Class->field[ $Field->key ] = array_merge([
                        'auto'      =>  'true',
                        'buttonText'=>  'Selecionar arquivos',
                        'max'       =>  10,
                        'path'      =>  '/' . str_singular( $Class->getTable() ) . '/',
                        'sizeLimit' =>  10,
                        'objName'   =>  'file',
                        'multi'     =>  'true',
                        'fileType'  =>  'image/*',
                        'resize'    =>  false
                    ], $Class->field[ $Field->key ]);
                    break;
            }

            $Class->field[ $Field->key ] = (object) $Class->field[ $Field->key ];
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
                'name'      =>  isset( $Model->field[ $Name ]->label ) ? $Model->field[ $Name ]->label : ucfirst( strtolower( str_replace('_', ' ', $Name) ) ),
                'key'       =>  $Name,
                'type'		=>	$Column->getType()->getName(),
                'length'	=>	$Column->getLength(),
                'scale'		=>	$Column->getScale(),
                'precision' =>	$Column->getPrecision()
            ];
        }

        return (object) $Columns;
    }

    /**
     * Get values save in database where @word_group_id
     *
     * @return object
     * */
    public function getValues($Model)
    {
        $Values = [];

        foreach ($Model->where('work_group_id', Session::get('work_group')->id)->orderBy('id', 'DESC')->get() as $Value ) {

            $Values[] = $this->formatData($Value, $Model);
        }

        return $Values;
    }

    /**
     * Get value save in database where @word_group_id
     *
     * @return object
     * */
    public function getValue($Model, $id)
    {
        $Model = $this->getModel( str_singular( $Model->getTable() ), true );
        $Value = [];

        if (! $Value = $Model->where('work_group_id', Session::get('work_group')->id)->where('id', $id)->first() ) {

            $Value = (object)[
              'id'  =>  false
            ];
        }

        $Value = $this->formatData($Value, $Model);

        return  $Value;
    }

    /**
     * Create form (HTML)
     *
     * @return HTML
     * */
    public function getForm($Value, $Model)
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
    public function formatData($Value, $Model)
    {
        foreach ($Model->field as $Field) {

            if (! isset( $Value->{$Field->key} ) ) continue;

            switch ($Field->type) {

                case 'decimal':

                    $Value->{$Field->key} = number_format( $Value->{$Field->key} , $Field->scale, ',', '.');
                    break;

                case 'pics':

                    $HTML = '';
                    $Path = public_path('img') . "{$Field->path}{$Value->id}/";

                    if (! empty($Value->{$Field->key}) && $Files = scandir( $Path ) ) {

                        $Location = $Value->{$Field->key};
                        $HTML .= view('grid.image', compact('Path', 'Field', 'Files', 'Location'))->render();

//                        foreach ( $Files as $File ) {
//
//                            if( @is_array( getimagesize( $Path . $File ) ) ) {
//
//                                $File     = pathinfo($File);
//                                $Location = $Value->{$Field->key};
//                                $HTML .= view('grid.image', compact('Field', 'File', 'Location'))->render();
//                            }
//                        }
                    }

                    $Value->{$Field->key} = $HTML;
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
    public function BRLCurrencyToFloat($number)
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
    public function BRLFloatToCurrency($number, $scale = 2)
    {
        if (is_numeric($number)) {
            $number = number_format($number, $scale);
        }

        return $number;
    }
}