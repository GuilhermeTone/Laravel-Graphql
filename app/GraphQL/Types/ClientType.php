<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;

use GraphQL\Type\Definition\Type;

class ClientType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Client',
        'description' => 'Tipo de Cliente'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'ID do cliente'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Nome do cliente'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'Email do cliente'
            ],
            'tel' => [
                'type' => Type::string(),
                'description' => 'Telefone do cliente'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Data de criação'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Data de atualização'
            ]
        ];
    }
}
