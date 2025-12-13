<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

trait AdminRequestTrait
{
    private array $errors = [];

    public function failedValidation(Validator $validator): void
    {
        $this->errors = (new ValidationException($validator))->errors();
    }

    public function getErrors() : array
    {
        return $this->errors;
    }
}
