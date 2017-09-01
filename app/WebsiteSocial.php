<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class WebsiteSocial extends Model
{
    protected $fillable = ['facebook', 'twitter', 'google_plus', 'linkedin', 'instagram', 'dribbble', 'skype', 'website_id'];

    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];

    public $title = 'Rede Social';

    public $field = [
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
