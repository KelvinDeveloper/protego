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
        $Model     = $this->ModelController->getModel($Model);
        $Value     = $this->ModelController->getValue($Model, $id);

        if (! $Value->id) {

            $Value = $Model;
            $Value->work_group_id = Session::get('work_group')->id;
        }

        $Post = $this->formatData($request->all(), $Model, $id);

        $Value->fill( $Post );
        $Value->save();

        $this->afterSave($request, $Model, $Value, $id );

        return redirect('/' . str_plural($Model->getTable()));
    }

    /**
     * Execution after save register
     * */
    public function afterSave(Request $request, $Model, $Value, $id )
    {
        foreach ($this->ModelController->getModel($Model->getTable(), true)->field as $Field) {

            switch ( $Field->type ) {

                case 'pics':

                    if ( $id == 'new' ) {
                        rename(storage_path() . "/tmp{$Field->path}{$request->hash}/", storage_path() . "/app/public{$Field->path}{$Value->id}/");
                        $Value->{$Field->key} = '/' . str_singular( $Model->getTable() ) . "/{$Value->id}/";
                    }
                    break;
            }
        }

        $Value->save();
    }

    /**
     * Format data for update database
     * */
    public function formatData($request, $Model, $id)
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

            $Field->path = storage_path() . "/tmp{$Field->path}{$request->hash}/";
        } else {

            $Field->path = storage_path() . "/app/public{$Field->path}{$id}/";
        }

        if ( is_array( $Field->resize ) ) {

            foreach ($Field->resize as $Size) {

                (new FolderController())->create("{$Field->path}thumb");

                $Object = \Image::make("{$Field->path}{$File->getClientOriginalName()}");
                $Object->resize($Size[0], $Size[1]);
                $Object->save("{$Field->path}thumb/{$File->getFileName()}-{$Size[0]}x$Size[1].{$File->getClientOriginalExtension()}");
            }
        }

        $File->move( $Field->path, $File->getClientOriginalName() );
    }
}