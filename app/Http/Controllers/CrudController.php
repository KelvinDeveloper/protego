<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CrudController extends Controller
{
    private $ModelController;

    public function __construct()
    {
        $this->ModelController = new ModelController();
    }

    /**
     * Save record model
     * */
    public function save (Request $request, $Model, $id)
    {
        $Model = $this->ModelController->getModel($Model);
        $Value = $this->ModelController->getValue($Model, $id);

        if (! $Value->id) {

            $Value = $Model;
            $Value->work_group_id = Session::get('work_group')->id;
        }

        $Post = $this->formatData($request->all(), $Model);

        $Value->fill( $Post );
        $Value->save();

        return redirect('/' . str_plural($Model->getTable()));
    }

    /**
     * Format data for update database
     * */
    public function formatData($request, $Model)
    {

        foreach ($this->ModelController->tableDetails($Model) as $Field) {

            if (! isset( $request[$Field->key] ) ) continue;

            switch ($Field->type) {

                case 'decimal':

                    $request[$Field->key] = $this->ModelController->BRLCurrencyToFloat($request[$Field->key]);
                    break;
            }
        }

        return $request;
    }

    /**
     * Delete record model
     * */
    public function delete ($Model, $id)
    {
        $Model = (new ModelController())->getModel($Model);
        $Item  = (new ModelController())->getValue($Model, $id);

        $Item->delete();

        return $Item;
    }

    /**
     * Upload archives
     * */
    public function uploadFile (Request $request, $Model, $id)
    {
        $Model = (new ModelController())->getModel($Model, true);

        $Field            = $Model->field[$request->name];
        $File             = $request->file('file');

        if ( $id == 'new' ) {

            $Field->path = storage_path() . '/tmp/' . $Field->path;
        } else {

            $Field->path = storage_path() . '/app/public/' . $Field->path;
        }

        $File->move( $Field->path, $File->getClientOriginalName() );
    }
}