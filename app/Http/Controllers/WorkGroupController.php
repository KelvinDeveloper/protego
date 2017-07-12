<?php

namespace App\Http\Controllers;

use App\WorkGroup;
use App\WorkGroupUser;
use Illuminate\Http\Request;

class WorkGroupController extends Controller
{
    /*
     * Create Work Group
     *
     * @param $User|object
     * @return object
     * */

    public function create ($User)
    {
        $WorkGroup = WorkGroup::create([
            'name'      =>  'Default',
            'user_id'   =>  $User->id
        ]);

        $WorkGroupUser = WorkGroupUser::create([
            'work_group_id' => $WorkGroup->id,
            'user_id'       => $User->id,
            'recording'     => 1
        ]);

        return [
            'WorkGroup'     =>  $WorkGroup,
            'WorkGroupUser' =>  $WorkGroupUser
        ];
    }
}
