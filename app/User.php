<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    public $access = ['api', 'form'];

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
            'multi'  =>  'false'
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

    public function customWhere ($Model) {

        return $Model->where('id', Auth::user()->id);
    }

}
