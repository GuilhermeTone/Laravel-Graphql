<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Order;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateOrderMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateOrder',
        'description' => 'Atualiza um pedido existente',
    ];

    public function type(): Type
    {
        return GraphQL::type('Order');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::id()),
                'rules' => ['required', 'exists:orders,id'],
            ],
            'quantity' => [
                'name' => 'quantity',
                'type' => Type::int(),
                'rules' => ['min:1'],
            ],
        ];
    }

    public function resolve($root, $args): Order
    {
        $order = Order::findOrFail($args['id']);
        
        if (isset($args['quantity'])) {
            $order->quantity = $args['quantity'];
        }

        $order->save();
        return $order;
    }
} 