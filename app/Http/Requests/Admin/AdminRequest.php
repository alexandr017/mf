<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class AdminRequest extends FormRequest
{
    private array $errors = [];

//    // конструктор нужен чт
//обы линтер не ругался
//    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
//    {
//        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
//        $this->errors = [];
//        $this->validator = app(\Illuminate\Contracts\Validation\Validator::class);
//        $this->convertedFiles = [];
//        $this->userResolver = app(\Closure::class);
//        $this->routeResolver = app(\Closure::class);
//        $this->session = null;
//        $this->content = $content;
//        $this->redirectAction = '';
//        $this->container = app(\Illuminate\Contracts\Container\Container::class);
//        $this->redirectRoute = '';
//        $this->redirect = '';
//        $this->redirector = app(\Illuminate\Routing\Redirector::class);
//    }

    public function failedValidation(Validator $validator)
    {
        $this->errors = (new ValidationException($validator))->errors();
    }

    public function getErrors() : array
    {
        return $this->errors;
    }
}
