<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class WebsitePortfolio extends Model
{
    protected $fillable = ['status', 'title', 'pic', 'description', 'href', 'website_id', 'work_group_id'];

    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];

    public $title = 'Portfolio';

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
        'pic'  =>  [
            'type'  =>  'pics',
            'multi' =>  'false',
            'label' =>  'Imagem',
            'resize'    =>  [ [100, 100], [150, 150], [650, 350] ]
        ],
        'description'  =>  [
            'label' =>  'Descrição',
        ],
        'href'  =>  [
            'label' =>  'Url',
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
