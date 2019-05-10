<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class WebsiteSlide extends Model
{
    public $fillable = ['pics', 'website_id', 'work_group_id'];
    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];
    public $title = 'Slider';

    public $field = [
        'pics'  =>  [
            'label'     =>  'Fotos',
            'type'      =>  'pics'
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