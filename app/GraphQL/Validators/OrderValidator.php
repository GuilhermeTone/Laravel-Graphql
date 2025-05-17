<?php

declare(strict_types=1);

namespace App\GraphQL\Validators;

use Illuminate\Support\Facades\Validator;

class OrderValidator
{
    public static function validate(array $data): array
    {
        $rules = [
            'client_id' => ['required', 'exists:clients,id'],
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];

        $messages = [
            'client_id.required' => 'O ID do cliente é obrigatório',
            'client_id.exists' => 'O cliente informado não existe',
            'product_id.required' => 'O ID do produto é obrigatório',
            'product_id.exists' => 'O produto informado não existe',
            'quantity.required' => 'A quantidade é obrigatória',
            'quantity.integer' => 'A quantidade deve ser um número inteiro',
            'quantity.min' => 'A quantidade deve ser maior que zero',
        ];

        return Validator::make($data, $rules, $messages)->validate();
    }

    public static function validateUpdate(array $data): array
    {
        $rules = [
            'id' => ['required', 'exists:orders,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];

        $messages = [
            'id.required' => 'O ID do pedido é obrigatório',
            'id.exists' => 'O pedido informado não existe',
            'quantity.required' => 'A quantidade é obrigatória',
            'quantity.integer' => 'A quantidade deve ser um número inteiro',
            'quantity.min' => 'A quantidade deve ser maior que zero',
        ];

        return Validator::make($data, $rules, $messages)->validate();
    }

    public static function validateDelete(array $data): array
    {
        $rules = [
            'id' => ['required', 'exists:orders,id'],
        ];

        $messages = [
            'id.required' => 'O ID do pedido é obrigatório',
            'id.exists' => 'O pedido informado não existe',
        ];

        return Validator::make($data, $rules, $messages)->validate();
    }
} 