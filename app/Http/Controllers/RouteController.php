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
     * Show grid module
     *
     * @return HTML | view()
     * */
    public function index ($Model)
    {
        $Model  = $this->ModelController->getModel($Model, true);

        if ($Model->paginate && is_numeric($Model->paginate)) {

            $Model->setPerPage($Model->paginate);
            $Model->paginate($Model->paginate);
        }

        if (! in_array('grid', $Model->access) ) {

            return redirect('/' . str_singular( $Model->getTable() ) . '/form');
        }

        $Table  = $this->ModelController->tableDetails($Model, 'grid');
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
        $Model = $this->ModelController->getModel($Model, true);
        $Value = $this->ModelController->getValue($Model, $id);
        $Form  = $this->ModelController->getForm($Value, $Model);

        return view('form.index', compact('Model', 'Value', 'Form'))->render();
    }
}