<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = ['status', 'title', 'description', 'domain', 'subdomain', 'ga', 'template', 'work_group_id'];

    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];

    public $title = 'Site';

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
        'description'  =>  [
            'label' =>  'Descrição',
        ],
        'domain'  =>  [
            'label' =>  'Dominio',
        ],
        'subdomain' =>  [
            'label' =>  'Subdominio',
        ],
        'template'    =>  [
            'type'  =>  'select',
            'options'   =>  [
                'creative'  =>  'Creative'
            ]
        ],
    ];
}
