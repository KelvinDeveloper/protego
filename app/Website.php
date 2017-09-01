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
            'options'   =>  []
        ],
        'ga'    =>  [
            'label' =>  'Chave Google Analytics'
        ]
    ];

    public function __construct ()
    {

        $templates = scandir( resource_path('views/website/templates') );

        foreach ( $templates as $template ) {

            $info = pathinfo( resource_path('views/website/templates/' . $template) );

            if (! is_dir( "{$info['dirname']}/$template" ) || in_array($template, ['.', '..']) ) continue;

            $this->field['template']['options'][ $template ] = ucfirst( str_replace('_', ' ', $template) );
        }
    }
}