<?php

namespace App\Functions;

use App\Http\Controllers\ModelController;
use App\Module;
use App\ModuleGroup;
use Form;
use Illuminate\Support\Facades\DB;
use Request;

class Menu
{
    public function left()
    {

        $Menu = [];
        $Loop = 0;

        foreach (ModuleGroup::orderBy('position', 'ASC')->get() as $Group) {

            unset($Group->title);
            $Menu[$Loop] = [
                'name'  =>  $Group->title,
                'icon'  =>  $Group->icon,
                'items' =>  []
            ];

            foreach (Module::where('group', $Group->id)->orderBy('position', 'ASC')->get() as $Module) {

                unset($Module->title);
                $Model = (new ModelController())->getModel($Module->title);

                $Menu[$Loop]['items'][] =  [
                    'name'  =>  str_singular($Model->title),
                    'href'  =>  '/' . strtolower( str_singular($Model->getTable()) )
                ];
            }

            $Loop++;
        }

        return view('menu.left', compact('Menu'))->render();
    }

    public function top()
    {
        return view('menu.top')->render();
    }
}