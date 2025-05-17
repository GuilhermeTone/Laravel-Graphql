<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Client;
use App\GraphQL\Validators\ClientValidator;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateClientMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createClient',
        'description' => 'Cria um novo cliente'
    ];

    public function type(): Type
    {
        return GraphQL::type('Client');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'description' => 'Nome do cliente'
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'description' => 'Email do cliente'
            ],
            'tel' => [
                'name' => 'tel',
                'type' => Type::string(),
                'description' => 'Telefone do cliente'
            ]
        ];
    }

    public function resolve($root, array $args)
    {
        ClientValidator::validate($args);

        $client = new Client();
        $client->name = $args['name'];
        $client->email = $args['email'];
        $client->tel = $args['tel'] ?? null;
        $client->save();

        return $client;
    }
}
