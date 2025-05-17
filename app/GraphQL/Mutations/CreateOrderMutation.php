<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Order;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\GraphQL\Validators\OrderValidator;

class CreateOrderMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createOrder',
        'description' => 'Cria um novo pedido',
    ];

    public function type(): Type
    {
        return GraphQL::type('Order');
    }

    public function args(): array
    {
        return [
            'client_id' => [
                'name' => 'client_id',
                'type' => Type::nonNull(Type::id()),
                'rules' => ['required', 'exists:clients,id'],
            ],
            'product_id' => [
                'name' => 'product_id',
                'type' => Type::nonNull(Type::id()),
                'rules' => ['required', 'exists:products,id'],
            ],
            'quantity' => [
                'name' => 'quantity',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'min:1'],
            ],
        ];
    }

    public function resolve($root, $args): Order
    {
        OrderValidator::validate($args);
        
        return Order::create([
            'client_id' => $args['client_id'],
            'product_id' => $args['product_id'],
            'quantity' => $args['quantity'],
        ]);
    }
} 