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
        $Value     = $this->ModelController->getValue($Model, $id, 'save');

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

                        (new FolderController())->create(public_path('/img/') . "{$Field->path}{$Value->id}/");

                        rename(storage_path() . "/tmp{$Field->path}{$request->hash}/", public_path('/img/') . "{$Field->path}{$Value->id}/");
                    }

                    $Value->{$Field->name} = '/' . str_singular( $Model->getTable() ) . "/{$Value->id}/";
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

            if (! isset( $request[$Field->name] ) ) continue;

            switch ($Field->type) {

                case 'decimal':

                    $request[$Field->name] = $this->ModelController->BRLCurrencyToFloat($request[$Field->name]);
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
        $Model = (new ModelController())->getModel($Model, true);
        $Item  = (new ModelController())->getValue($Model, $id);

        $Item->delete();

        foreach ($Model->field as $Field) {

            switch ($Field->type) {

                case 'pics':
                    \File::deleteDirectory(public_path('img') . "{$Field->path}{$id}/");
                    break;
            }
        }

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

            $Field->path = public_path('/img/') . "{$Field->path}{$id}/";
        }
        $File->move( $Field->path, $File->getClientOriginalName() );

        if ( is_array( $Field->resize ) ) {

            foreach ($Field->resize as $Size) {

                $Info = pathinfo($File->getClientOriginalName());

                (new FolderController())->create("{$Field->path}thumb");

                $Object = \Image::make("{$Field->path}{$File->getClientOriginalName()}");
                $Object->resize($Size[0], $Size[1], function ($constraint) {
                    $constraint->aspectRatio();
                });

                $Object->save("{$Field->path}thumb/{$Info['filename']}-{$Size[0]}x$Size[1].{$File->getClientOriginalExtension()}");
            }
        }
    }

    /**
     * Delete archives
     * */
    public function deleteFile (Request $request, $Model, $id)
    {
        $Model = $this->ModelController->getModel($Model, true);

        if ( $id != 'new' ) {

            $Value = $this->ModelController->getValue($Model, $id);

            if (! $Value ) {

                abort(500);
            }
        }

        $File = pathinfo( public_path() . $request->location);

        \File::delete( public_path() . $request->location );

        foreach ($Model->field[ $request->field ]->resize as $Size) {

            \File::delete( $File['dirname'] . "/thumb/{$File['filename']}-{$Size[0]}x{$Size[1]}.{$File['extension']}" );
        }

        return $File;
    }
}