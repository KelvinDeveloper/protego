<?php

namespace App\Http\Controllers;

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
            'title' =>  ucfirst( strtolower( str_plural( $Class->getTable() ) ) )
        ];

        foreach ($Default as $key => $value) {

            if (! isset( $Class->{$key} ) ) {

                $Class->{$key} = $value;
            }
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
                'name'      =>  ucfirst( strtolower( str_replace('_', ' ', $Name) ) ),
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
        return $Model->where('work_group_id', Session::get('work_group')->id)->orderBy('id', 'DESC')->get();
    }

    /**
     * Get value save in database where @word_group_id
     *
     * @return object
     * */
    public function getValue($Model, $id)
    {
        $Value = [];

        if (! $Value = $Model->where('work_group_id', Session::get('work_group')->id)->where('id', $id)->first() ) {

            $Value = (object)[
              'id'  =>  false
            ];
        }
        return  $Value;
    }

    /**
     * Create form (HTML)
     *
     * @return HTML
     * */
    public function getForm($Table, $Value)
    {
        $HTML = '';

        foreach ($Table as $Name => $Field) {

            $Field->value = isset( $Value->{$Name} ) ? $Value->{$Name} : '';

            switch ($Field->type) {

                case 'text':
                    $HTML .= view('form.textarea', compact('Field'))->render();
                    break;
                default:
                    $HTML .= view('form.input', compact('Field'))->render();
                    break;
            }
        }

        return $HTML;
    }
}
