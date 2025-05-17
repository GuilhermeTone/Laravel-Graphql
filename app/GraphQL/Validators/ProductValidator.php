<?php

declare(strict_types=1);

namespace App\GraphQL\Validators;

use Illuminate\Support\Facades\Validator;

class ProductValidator
{
    public static function validate(array $data): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ];

        $messages = [
            'name.required' => 'O nome do produto é obrigatório',
            'name.string' => 'O nome deve ser um texto',
            'name.max' => 'O nome não pode ter mais que 255 caracteres',
            'description.required' => 'A descrição é obrigatória',
            'description.string' => 'A descrição deve ser um texto',
            'price.required' => 'O preço é obrigatório',
            'price.numeric' => 'O preço deve ser um número',
            'price.min' => 'O preço não pode ser negativo',
        ];

        return Validator::make($data, $rules, $messages)->validate();
    }

    public static function validateDelete(array $data): array
    {
        $rules = [
            'id' => ['required', 'exists:products,id'],
        ];

        $messages = [
            'id.required' => 'O ID do produto é obrigatório',
            'id.exists' => 'O produto informado não existe',
        ];

        return Validator::make($data, $rules, $messages)->validate();
    }
} 