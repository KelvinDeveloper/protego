<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class WebsiteMenu extends Model
{
    protected $fillable = ['status', 'name', 'href', 'target', 'position', 'website_id', 'work_group_id'];

    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];

    public $title = 'Itens Menu';

    public $field = [
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
        'href'  =>  [
            'label' =>  'Url',
        ],
        'target'    =>  [
            'label'     =>  'Abrir página',
            'type'      =>  'select',
            'options'   =>  [
                '_parent'   =>  'Mesma aba',
                '_blank'    =>  'Nova aba'
            ]
        ],
        'website_id'    =>  [
            'label'     =>  'Site',
            'type'      =>  'select',
            'options'   =>  []
        ]
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        foreach (Website::where('work_group_id', Session::get('work_group')->id)->orderBy('title', 'ASC')->get() as $Website) {
            unset($Website->title);
            $this->field['website_id']['options'][ $Website->id ] = $Website->title;
        }
    }
}
