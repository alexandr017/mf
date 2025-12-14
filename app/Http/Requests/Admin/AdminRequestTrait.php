<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

trait AdminRequestTrait
{
    private array $errors = [];

    public function failedValidation(Validator $validator): void
    {
        $exception = new ValidationException($validator);
        $this->errors = $exception->errors();
        
        // Выбрасываем исключение, чтобы Laravel автоматически сделал редирект назад с ошибками
        throw $exception;
    }

    public function getErrors() : array
    {
        return $this->errors;
    }
}
