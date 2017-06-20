<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public $fields =  [
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

}
