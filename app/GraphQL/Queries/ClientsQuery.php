<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Client;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ClientsQuery extends Query
{
    protected $attributes = [
        'name' => 'clients',
        'description' => 'Lista todos os clientes'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Client'));
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, SelectFields $fields)
    {
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return Client::select($select)->with($with)->get();
    }
}
