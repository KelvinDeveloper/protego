<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use Notifiable;

    // public $access = ['api', 'form'];
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
        'password',
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

    public function gridCustomWhere ($Model) {

        $Users = WorkGroupUser::select(['user_id'])->where('work_group_id', Session::get('work_group')->id)->get();

        $Array = [];

        foreach ($Users as $User) {
            $Array[] = $User->user_id;
        }

         return $Model->whereIn('id', $Array);
    }

}
