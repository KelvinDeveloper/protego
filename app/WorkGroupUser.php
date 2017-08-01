<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkGroupUser extends Model
{
    protected $fillable = ['work_group_id', 'user_id', 'recording'];

    public $hidden = ['id', 'created_at', 'updated_at'];

    public $title = 'Grupo de Trabalho - Usuários';

    public $field = [
        'work_group_id'    =>  [
            'label'     =>  'Grupo de Trabalho',
            'type'      =>  'select',
            'options'   =>  []
        ],
        'user_id'    =>  [
            'label'     =>  'Usuário',
            'type'      =>  'select',
            'options'   =>  []
        ],
        'recording'    =>  [
            'label'     =>  'Lembrar',
            'type'      =>  'select',
            'options'   =>  [
                1  =>  'Sim',
                0  =>  'Não'
            ]
        ],
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $Query = WorkGroup::select(['id', 'name'])->get();

        foreach ($Query as $WorkGroup) {

            $this->field['work_group_id']['options'][$WorkGroup->id] = "#{$WorkGroup->id} - {$WorkGroup['name']}";
        }

        $Query = User::select(['id', 'name'])->get();

        foreach ($Query as $User) {

            $this->field['user_id']['options'][$User->id] = $User->name;
        }
    }
}
