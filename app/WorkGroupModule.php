<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkGroupModule extends Model
{
    protected $fillable = ['module_id', 'work_group_id', 'permissions'];

    public $hidden = ['id', 'created_at', 'updated_at'];

    public $title = 'Group de Trabalho - Modulos';

    public $field = [
        'module_id'    =>  [
            'label'     =>  'Modulo',
            'type'      =>  'select',
            'options'   =>  []
        ],
        'work_group_id'    =>  [
            'label'     =>  'Grupo de Trabalho',
            'type'      =>  'select',
            'options'   =>  []
        ],
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        foreach (Module::get() as $Module) {
            unset($Module->title);

            $this->field['module_id']['options'][$Module->id] = $Module->title;
        }

        foreach (WorkGroup::get() as $Group) {

            $this->field['work_group_id']['options'][$Group->id] = "#{$Group->id} - {$Group->name}";
        }
    }
}
