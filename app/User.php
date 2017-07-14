<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use Notifiable;

    public $title = 'Usuário';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pic', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $hidden = [
        'remember_token',
        'created_at',
        'updated_at'
    ];

    public $table = 'users';

    public $field =  [
        'pic'  =>  [
            'type'  =>  'pics',
            'multi' =>  'false',
            'label' =>  'Foto'
        ],
        'name'  =>  [
            'label' =>  'Nome'
        ],
        'email' =>  [
            'type'  =>  'email'
        ],
        'password'  =>  [
            'type'  =>  'password',
            'label' =>  'Senha'
        ]
    ];

    public $form = [
        'title'     =>  'User',
        'hidden'    =>   ['id'],
        'return'    =>  '/users',
        'action'    =>  '/user/{id}/save',
        'hidden'    =>  ['id', 'remember_token'],
    ];

    public $grid = [
        'title' =>  'Users',
        'paginate'  =>  [
            'items' => 15
        ],
        'hidden'    =>  ['password', 'remember_token'],
        'url'       =>  '/user'
    ];

    public function gridCustomWhere ($Model)
    {

        $Users = WorkGroupUser::select(['user_id'])
            ->where('work_group_id', Session::get('work_group')->id)
            ->where('id', '!=', Auth::user()->id)
            ->where('id', '!=', Session::get('work_group')->user_id);

        $Array = [];

        foreach ($Users->get() as $User) {
            $Array[] = $User->user_id;
        }

         return $Model->whereIn('id', $Array);
    }

    public function afterSave ($request, $ModelDefault, $Value, $id)
    {
        if ( $id == 'new' ) {

            $WorkGroup                  = new WorkGroupUser;

            $WorkGroup->work_group_id   = Session::get('work_group')->id;
            $WorkGroup->user_id         = $Value->id;
            $WorkGroup->recording       = 1;

            $WorkGroup->save();
        }

        return true;
    }
}
