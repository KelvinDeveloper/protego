<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class WebsitePage extends Model
{
    protected $fillable = ['status', 'title', 'url', 'content', 'website_id', 'work_group_id'];

    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];

    public $title = 'Páginas';

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
        'url'  =>  [
            'label' =>  'Url',
        ],
        'content'    =>  [
            'label'     =>  'Conteúdo',
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
