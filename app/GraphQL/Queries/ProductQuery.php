<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Product;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ProductQuery extends Query
{
    protected $attributes = [
        'name' => 'product',
        'description' => 'Retorna um produto por id'
    ];

    public function type(): Type
    {
        return GraphQL::type('Product');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Informe o ID do produto que deseja consultar',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Product::findOrFail($args['id']);
    }
}
