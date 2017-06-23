<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'work_group_id'];

    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];

    public $title = 'Produto';

    public $field = [
        'pics'  =>  [
            'label'     =>  'Fotos',
            'type'      =>  'pics',
            'max'       =>  10,
            'path'      =>  '/product/',
            'resize'    =>  [ [50, 50], [150, 150] ]
        ],
        'name'  =>  [
            'label' =>  'Nome',
        ],
        'description'  =>  [
            'label' =>  'Descrição',
        ],
        'price'  =>  [
            'label' =>  'Preço',
        ],
    ];
}
