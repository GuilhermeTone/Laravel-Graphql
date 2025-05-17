<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Order;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\GraphQL\Validators\OrderValidator;

class DeleteOrderMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteOrder',
        'description' => 'Deleta um pedido',
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::id()),
            ],
        ];
    }

    public function resolve($root, $args): bool
    {
        OrderValidator::validateDelete($args);
        
        $order = Order::findOrFail($args['id']);
        return $order->delete();
    }
} 