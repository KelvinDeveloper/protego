<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Store extends Model
{
    public $access = ['api', 'form'];

    protected $fillable = ['name', 'description', 'phone', 'cep', 'state', 'city', 'street', 'emails', 'work_group_id'];

    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];

    public $title = 'Loja';

    public $field = [
        'name'  =>  [
            'label' =>  'Nome'
        ],
        'description'  =>  [
            'label' =>  'Descrição',
        ],
        'cep'   =>  [
            'type'  =>  'cep'
        ],
        'street'    =>  [
            'label' =>  'Rua'
        ],
        'state' =>  [
            'type'  =>  'select',
            'label' =>  'Estado',
            'options'   =>  [
                'AC' => 'Acre',
                'AL' => 'Alagoas',
                'AP' => 'Amapá',
                'AM' => 'Amazonas',
                'BA' => 'Bahia',
                'CE' => 'Ceará',
                'DF' => 'Distrito Federal',
                'ES' => 'Espírito Santo',
                'GO' => 'Goiás',
                'MA' => 'Maranhão',
                'MT' => 'Mato Grosso',
                'MS' => 'Mato Grosso do Sul',
                'MG' => 'Minas Gerais',
                'PA' => 'Pará',
                'PB' => 'Paraíba',
                'PR' => 'Paraná',
                'PE' => 'Pernambuco',
                'PI' => 'Piauí',
                'RJ' => 'Rio de Janeiro',
                'RN' => 'Rio Grande do Norte',
                'RS' => 'Rio Grande do Sul',
                'RO' => 'Rondônia',
                'RR' => 'Roraima',
                'SC' => 'Santa Catarina',
                'SP' => 'São Paulo',
                'SE' => 'Sergipe',
                'TO' => 'Tocantins'
            ]
        ],
        'city'  =>  [
            'label' =>  'Cidade'
        ],
        'phone' =>  [
            'type'  =>  'phone',
            'label' =>  'Telefone'
        ],
    ];

    public function formCustomWhere($Model) {
        return $Model->where('work_group_id', Session::get('work_group')->id);
    }
}
