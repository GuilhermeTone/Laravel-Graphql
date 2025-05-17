<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\Validators\ClientValidator;
use App\Models\Client;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class DeleteClientMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteClient',
        'description' => 'Deleta um cliente'
    ];

    public function type(): Type
    {
        return GraphQL::type('Client');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID do cliente'
            ]
        ];
    }

    public function resolve($root, array $args)
    {
        ClientValidator::validateDelete($args);
        
        $client = Client::findOrFail($args['id']);
        $client->delete();
        return $client;
    }
}
