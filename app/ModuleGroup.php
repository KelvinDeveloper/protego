<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleGroup extends Model
{
    protected $fillable = ['status', 'title', 'icon', 'description', 'price', 'group', 'position'];

    public $hidden = ['id', 'created_at', 'updated_at'];

    public $title = 'Modulo';

    public $field = [
        'status'    =>  [
            'type'  =>  'select',
            'options'   =>  [
                1   =>  'Ativo',
                0   =>  'Inativo'
            ]
        ],
        'title'  =>  [
            'label' =>  'Título',
        ],
        'icon'  =>  [
            'label' =>  '<a href="https://material.io/icons/" target="_blank">Icone</a>',
        ],
        'description'  =>  [
            'label' =>  'Descrição',
        ],
        'position'  =>  [
            'label' =>  'Posição'
        ]
    ];
}
