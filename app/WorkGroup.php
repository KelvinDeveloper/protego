<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkGroup extends Model
{
    protected $fillable = ['facebook', 'twitter', 'google_plus', 'linkedin', 'instagram', 'dribbble', 'skype'];
    public $hidden = ['id', 'created_at', 'updated_at'];

    public $title = 'Grupo de Trabalho';

    public $field = [
        'name'    =>  [
            'label'     =>  'Nome',
        ],
        'user_id'    =>  [
            'label'     =>  'Administrador',
            'type'      =>  'select',
            'options'   =>  []
        ],
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $Query = User::select(['id', 'name'])->get();

        foreach ($Query as $User) {

            $this->field['user_id']['options'][$User->id] = $User->name;
        }
    }
}
