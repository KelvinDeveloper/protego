<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Showcase extends Model
{
    public $access = ['api', 'form'];

    protected $fillable = ['status', 'title', 'show_out_of_stock', 'show_prices', 'show_stock'];

    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];

    public $title = 'Vitrine';

    public $field = [
        'status'    =>  [
            'type'  =>  'select',
            'options'   =>  [
                1   =>  'Ativo',
                0   =>  'Inativo'
            ],
        ],
        'title' =>  [
            'label' =>  'Título'
        ],
        'show_out_of_stock' =>  [
            'type'  =>  'select',
            'options'   =>  [
                1   =>  'Sim',
                0   =>  'Não'
            ],
            'label' =>  'Mostrar produtos fora de estoque'
        ],
        'show_prices' =>  [
            'type'  =>  'select',
            'options'   =>  [
                1   =>  'Sim',
                0   =>  'Não'
            ],
            'label' =>  'Mostrar preço'
        ],
        'show_stock' =>  [
            'type'  =>  'select',
            'options'   =>  [
                1   =>  'Sim',
                0   =>  'Não'
            ],
            'label' =>  'Mostrar quantidade em estoque'
        ]
    ];
    public function formCustomWhere($Model) {
        return $Model->where('work_group_id', Session::get('work_group')->id);
    }

}
