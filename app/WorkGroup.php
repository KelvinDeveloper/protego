<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkGroup extends Model
{

    protected  $table = 'work_group';

    protected $fillable = ['name', 'user_id'];
}
