<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'work_group_id'];

    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];

    public $title = 'Produto';

    // public $access = ['api', 'form'];

    public $field = [
        'pics'  =>  [
            'label'     =>  'Fotos',
            'type'      =>  'pics'
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

    public function formCustomWhere ($Model) {

        return $Model->where('id', 10);
    }
}
