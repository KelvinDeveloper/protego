<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Create folders and sub folders ex.: (/new/folders/create)
     *
     * @return bool
     * */
    public function create($location)
    {
        $path = '';

        foreach ( explode('/', $location) as $dir )
        {

            $dir = "/{$dir}";

            if (! file_exists("{$path}{$dir}") )
            {
                mkdir("{$path}{$dir}");
                chmod("{$path}{$dir}", 0777);
            }

            $path .= "{$dir}";
        }

        return true;
    }
}
