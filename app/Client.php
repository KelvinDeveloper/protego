<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $fillable = [
        'name', 'email', 'cep', 'street', 'number', 'state', 'city', 'complement', 'phone', 'cel', 'facebook', 'instagram', 'twitter'
    ];

    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];

    public $title = 'Cliente';

    public $grid = [
        'hidden'    =>  ['cep', 'street', 'number', 'state', 'city', 'complement', 'facebook', 'instagram', 'twitter']
    ];
}