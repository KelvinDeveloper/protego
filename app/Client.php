<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $fillable = [
        'pic', 'name', 'email', 'cep', 'street', 'number', 'state', 'city', 'complement', 'phone', 'cel', 'facebook', 'instagram', 'twitter'
    ];

    public $hidden = ['id', 'work_group_id', 'created_at', 'updated_at'];

    public $title = 'Cliente';

    public $grid = [
        'hidden'    =>  ['cep', 'street', 'number', 'state', 'city', 'complement', 'facebook', 'instagram', 'twitter']
    ];

    public $field = [
        'pic'   =>  [
            'type'  =>  'pics',
            'multi' =>  'false',
            'label' =>  'Foto',
        ],
        'name'  =>  [
            'label' =>  'Nome'
        ],
        'email' =>  [
            'type'  =>  'email'
        ],
        'cep'   =>  [
            'type'  =>  'cep'
        ],
        'street'    =>  [
            'label' =>  'Rua'
        ],
        'number'    =>  [
            'type'  =>  'number',
            'label' =>  'Numero'
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
        'complement'    =>  [
            'label' =>  'Complemento',
        ],
        'phone' =>  [
            'type'  =>  'phone',
            'label' =>  'Telefone'
        ],
        'cel'   =>  [
            'type'  =>  'phone',
            'label' =>  'Celular'
        ]
    ];
}