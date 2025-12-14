<?php

namespace App\Http\Requests\Admin\Countries;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class CountryRequest extends FormRequest
{
    use AdminRequestTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'code' => ['nullable', 'max:3'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Название',
            'code' => 'Код',
        ];
    }
}


