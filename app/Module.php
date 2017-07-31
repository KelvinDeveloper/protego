<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['status', 'title', 'description', 'price', 'group', 'show_menu'];

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
        'description'  =>  [
            'label' =>  'Descrição',
        ],
        'price'  =>  [
            'label' =>  'Preço',
        ],
        'group' =>  [
            'label' =>  'Agrupar',
            'type'  =>  'select',
            'options'   => []
        ],
        'position'  =>  [
            'label' =>  'Posição'
        ],
        'show_menu'    =>  [
            'label' =>  'Mostrar no menu',
            'type'  =>  'select',
            'options'   =>  [
                1   =>  'Sim',
                0   =>  'Não'
            ]
        ],
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $ModuleGroups = ModuleGroup::select(['id', 'title'])->get();

        foreach ($ModuleGroups as $Group) {

            unset($Group->title);
            $this->field['group']['options'][$Group->id] = $Group->title;
        }
    }
}
