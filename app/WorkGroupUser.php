<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkGroupUser extends Model
{
    protected $table = 'user_work_group';

    protected $fillable = ['work_group_id', 'user_id', 'recording'];
}
