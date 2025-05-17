<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\Validators\ClientValidator;
use App\Models\Client;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateClientMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateClient',
        'description' => 'Atualiza um cliente existente'
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
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                'description' => 'Nome do cliente'
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
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

        $client = Client::findOrFail($args['id']);
        
        if (isset($args['name'])) {
            $client->name = $args['name'];
        }
        if (isset($args['email'])) {
            $client->email = $args['email'];
        }
        if (isset($args['tel'])) {
            $client->tel = $args['tel'];
        }
        
        $client->save();
        return $client;
    }
}
