<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Product',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'ID do produto'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Nome do produto'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Descrição do produto'
            ],
            'price' => [
                'type' => Type::float(),
                'description' => 'Preço do produto'
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
