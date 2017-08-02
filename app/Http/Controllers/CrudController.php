<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Response;

class CrudController extends Controller
{
    private $ModelController;

    public function __construct()
    {
        $this->ModelController = new ModelController();
    }

    /**
     * Valid request for save
     * */
    public function validation(array $request, $Model, $id)
    {
        $Validate  = [];
        $Attributes = [];

        foreach ($Model->field as $Field) {

            if ( $Field->notNull ) {

                if ( $Field->type == 'password' && $id ) continue;

                $Validate[ $Field->name ] = 'required';
                $Attributes[ $Field->name ] = $Field->label;
            }
        }

        $Validator = Validator::make($request, $Validate);
        $Validator->setAttributeNames($Attributes);

        return $Validator;
    }

    /**
     * Save record model
     * */
    public function save (Request $request, $Model, $id)
    {
        $ModelDefault   = $this->ModelController->getModel($Model, true);
        $Model          = $this->ModelController->getModel($Model);
        $Value          = $this->ModelController->getValue($Model, $id, 'save');

        if (! $Value->id) {

            $Value = $Model;

            if ( in_array('work_group_id', $Model->hidden) ) {

                $Value->work_group_id = Session::get('work_group')->id;
            }
        }

        $Post      = $this->formatData($request->all(), $ModelDefault, $id);
        $Validator = $this->validation($Post, $ModelDefault, $id);

        if ( $Validator->fails() ) {

            return Response::json($Validator->errors(), 500);
        }

        $Value->fill( $Post );
        $Value->save();

        $this->afterSave($request, $ModelDefault, $Value, $id);

        if ( method_exists( $Model, 'afterSave' ) ) {

            if ( $Model->afterSave($request, $ModelDefault, $Value, $id) !== true ) {

                return $Model->afterSave($request, $ModelDefault, $Value, $id);
            }
        }

        return ['status' => true, 'redirect' => '/' . str_singular($Model->getTable())];
    }

    /**
     * Execution after save register
     * */
    public function afterSave(Request $request, $Model, $Value, $id )
    {
        foreach ($Model->field as $Field) {

            switch ( $Field->type ) {

                case 'pics':

                    if ( $id == 'new' ) {

                        if (! file_exists( public_path('tmp') . "{$Field->path}{$request->hash}/" ) ) continue;

                        (new FolderController())->create(public_path('/img/') . "{$Field->path}{$Value->id}/");

                        rename(public_path('tmp') . "{$Field->path}{$request->hash}/", public_path('/img/') . "{$Field->path}{$Value->id}/");
                    }

                    if ( $Field->multi == 'false' ) {

                        if ( empty( $Value->{$Field->name} ) ) {

                            unset( $Value->{$Field->name} );
                            continue;
                        }

                        $File = pathinfo($Value->{$Field->name});
                        $Value->{$Field->name} = '/' . str_singular( $Model->getTable() ) . "/{$Value->id}/{$File['basename']}";
                    } else if ( $Field->multi == 'true' ) {
                        $Value->{$Field->name} = '/' . str_singular( $Model->getTable() ) . "/{$Value->id}/";
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
        // $request = array_filter($request);

        foreach ($Model->field as $Field) {

            if (! isset( $request[$Field->name] ) ) continue;

            switch ($Field->type) {

                case 'decimal':

                    $request[$Field->name] = $this->ModelController->BRLCurrencyToFloat($request[$Field->name]);
                    break;

                case 'password':

                    if (! isset( $request[$Field->name . '_current'] )) {

                        $request[$Field->name . '_current'] = 'new';
                    }

                    /**
                     * Case all variables ! empty
                     * */
                    if (! empty( $request[$Field->name] ) && ! empty( $request[$Field->name . '_current'] && ! empty( $request[$Field->name . '_confirmation'] ) ) ) {

                        /**
                         * Case current password == Auth::user()->password
                         * */
                        $Validator = Validator::make($request, [
                            'password' => 'required|min:6|confirmed'
                        ]);

                        if (! $Validator->fails()) {

                            if ( Hash::check($request[$Field->name . '_current'], Auth::user()->password) || ! is_numeric($id) ) {

                                $request[$Field->name] = bcrypt($request[$Field->name]);
                                unset( $request[$Field->name . '_confirmation'], $request[$Field->name . '_current'] );
                                continue;
                            }
                        }
                    }

                    unset( $request[$Field->name . '_confirmation'], $request[$Field->name . '_current'], $request[$Field->name] );
                    break;

                case 'pics':

                    if ( empty( $request[$Field->name] ) ) {

                        unset($request[$Field->name]);
                    }
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

        $Field            = $Model->field->{$request->name};
        $File             = $request->file('file');

        if ( $id == 'new' ) {

            $Field->path = public_path('tmp') . "{$Field->path}{$request->hash}/";
        } else {

            $Field->path = public_path('/img/') . "{$Field->path}{$id}/";
        }

        (new FolderController())->create($Field->path);
        chmod($Field->path, 0777);

        $File->move( $Field->path, $File->getClientOriginalName() );

        if ( is_array( $Field->resize ) ) {

            foreach ($Field->resize as $Size) {

                $Info = pathinfo($File->getClientOriginalName());

                (new FolderController())->create("{$Field->path}thumb");
                chmod("{$Field->path}thumb", 0777);

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

            if ( $Model->field->{$request->field}->multi == 'false' ) {

                $Value->{$request->field} = '';
                $Value->save();
            }
        }

        $File = pathinfo( public_path() . $request->location);

        \File::delete( public_path() . $request->location );

        foreach ($Model->field->{$request->field}->resize as $Size) {

            \File::delete( $File['dirname'] . "/thumb/{$File['filename']}-{$Size[0]}x{$Size[1]}.{$File['extension']}" );
        }

        return $File;
    }
}