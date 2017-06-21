<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CrudController extends Controller
{
    /**
     * Save module
     * */
    public function save (Request $request, $Model, $id)
    {
        $Model = (new ModelController())->getModel($Model);
        $Value = (new ModelController())->getValue($Model, $id);

        if (! $Value->id) {

            $Value = $Model;
            $Value->work_group_id = Session::get('work_group')->id;
        }

        $Value->fill($request->all());
        $Value->save();

        return redirect('/' . str_plural($Model->getTable()));
    }
}
