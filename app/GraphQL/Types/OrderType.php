<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Order;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class OrderType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Order',
        'description' => 'Tipo que representa um pedido',
        'model' => Order::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'ID do pedido',
            ],
            'client' => [
                'type' => Type::nonNull(GraphQL::type('Client')),
                'description' => 'Cliente que fez o pedido',
            ],
            'product' => [
                'type' => Type::nonNull(GraphQL::type('Product')),
                'description' => 'Produto do pedido',
            ],
            'quantity' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Quantidade do produto',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Data de criação do pedido',
            ],
        ];
    }
} 