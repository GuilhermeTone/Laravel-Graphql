<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\GraphQL\Types\ProductType;
use App\Models\Product;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ProductsQuery extends Query
{
    protected $attributes = [
        'name' => 'products',
        'description' => 'Lista todos os produtos'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Product'));
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, SelectFields $fields)
    {
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return Product::select($select)->with($with)->get();
    }
}
