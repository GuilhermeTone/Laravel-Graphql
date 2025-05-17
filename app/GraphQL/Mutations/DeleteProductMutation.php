<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\Validators\ProductValidator;
use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DeleteProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteProduct',
        'description' => 'Deleta um produto'
    ];

    public function type(): Type
    {
        return GraphQL::type('Product');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID do produto'
            ]
        ];
    }

    public function resolve($root, array $args)
    {
        ProductValidator::validateDelete($args);

        $product = Product::findOrFail($args['id']);
        $product->delete();
        return $product;
    }
}
