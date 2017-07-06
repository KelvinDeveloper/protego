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
            'type'      =>  'pics'
        ],
        'status'    =>  [
            'type'  =>  'select',
            'options'   =>  [
                1   =>  'Ativo',
                0   =>  'Inativo'
            ]
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
        'stock' =>  [
            'label' =>  'Quantidade em estoque',
            'type'  =>  'number'
        ],
        'height'    =>  [
            'label' =>  'Altura',
            'type'  =>  'number'
        ],
        'width' =>  [
            'label' =>  'Largura',
            'type'  =>  'number'
        ],
        'length'    =>  [
            'label' =>  'Comprimento',
            'type'  =>  'number'
        ]
    ];

    public $grid = [
        'hidden'    =>  ['description', 'height', 'width', 'length']
    ];

    public function formCustomWhere ($Model) {

        return $Model->where('id', 11);
    }
}
