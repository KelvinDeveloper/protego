<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteController extends Controller
{
    private $ModelController;

    public function __construct()
    {
        $this->ModelController = new ModelController();
    }

    /**
     * Get model
     *
     * @return object
    */
    public function getModel ($Model)
    {
        $Model = ucfirst( strtolower( str_singular( $Model ) ) );

        if (! file_exists( app_path() . "/{$Model}.php" ) ) {

            abort(404);
        }

        $Class = "\\App\\{$Model}";
        $Class = new $Class;

        if (! $Class->title) {

            $Class->title = $Model;
        }

        return $Class;
    }

    /**
     * Show grid module
     *
     * @return HTML | view()
     * */
    public function index ($Model)
    {
        $Model  = $this->getModel($Model);
        $Table  = $this->ModelController->tableDetails($Model);
        $Values = $this->ModelController->getValues($Model);

        return view('grid.index', compact('Model', 'Table', 'Values'))->render();
    }

    /**
     * Show item form
     *
     * @return HTML | view()
     * */
    public function show ($Model, $id)
    {
        $Model = $this->getModel($Model);
        $Value = $this->ModelController->getValue($Model, $id);
        $Table  = $this->ModelController->tableDetails($Model);
        $Form  = $this->ModelController->getForm($Table, $Value);

        return view('form.index', compact('Model', 'Value', 'Form'))->render();
    }
}