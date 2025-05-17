<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Product;
use App\GraphQL\Validators\ProductValidator;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createProduct',
        'description' => 'Cria um novo produto'
    ];

    public function type(): Type
    {
        return GraphQL::type('Product');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'description' => 'Nome do produto'
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string(),
                'description' => 'Descrição do produto'
            ],
            'price' => [
                'name' => 'price',
                'type' => Type::nonNull(Type::float()),
                'description' => 'Preço do produto'
            ]
        ];
    }

    public function resolve($root, array $args)
    {
        ProductValidator::validate($args);

        $product = new Product();
        $product->name = $args['name'];
        $product->description = $args['description'] ?? null;
        $product->price = $args['price'];
        $product->save();

        return $product;
    }
}
