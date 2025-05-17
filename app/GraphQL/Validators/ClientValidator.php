<?php

declare(strict_types=1);

namespace App\GraphQL\Validators;

use Illuminate\Support\Facades\Validator;

class ClientValidator
{
    public static function validate(array $data): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:clients,email'],
            'tel' => ['nullable', 'string', 'max:20'],
        ];

        $messages = [
            'name.required' => 'O nome do cliente é obrigatório',
            'name.string' => 'O nome deve ser um texto',
            'name.max' => 'O nome não pode ter mais que 255 caracteres',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser válido',
            'email.unique' => 'Este email já está cadastrado',
            'tel.string' => 'O telefone deve ser um texto',
            'tel.max' => 'O telefone não pode ter mais que 20 caracteres',
        ];

        return Validator::make($data, $rules, $messages)->validate();
    }

    public static function validateDelete(array $data): array
    {
        $rules = [
            'id' => ['required', 'exists:clients,id'],
        ];

        $messages = [
            'id.required' => 'O ID do cliente é obrigatório',
            'id.exists' => 'O cliente informado não existe',
        ];

        return Validator::make($data, $rules, $messages)->validate();
    }
} 