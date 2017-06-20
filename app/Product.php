<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'work_group_id'];

    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];
}
