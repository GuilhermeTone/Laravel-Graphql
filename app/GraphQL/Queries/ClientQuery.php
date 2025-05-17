<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Client;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ClientQuery extends Query
{
    protected $attributes = [
        'name' => 'client',
        'description' => 'Retorna um cliente por id'
    ];

    public function type(): Type
    {
        return GraphQL::type('Client');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID do cliente',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Client::findOrFail($args['id']);
    }
}
