<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\Validators\ProductValidator;
use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateProduct',
        'description' => 'Atualiza um produto existente'
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
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                'description' => 'Nome do produto'
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string(),
                'description' => 'Descrição do produto'
            ],
            'price' => [
                'name' => 'price',
                'type' => Type::float(),
                'description' => 'Preço do produto'
            ]
        ];
    }

    public function resolve($root, array $args)
    {

        $product = Product::findOrFail($args['id']);
        
        if (isset($args['name'])) {
            $product->name = $args['name'];
        }
        if (isset($args['description'])) {
            $product->description = $args['description'];
        }
        if (isset($args['price'])) {
            $product->price = $args['price'];
        }
        
        $product->save();
        return $product;
    }
}
