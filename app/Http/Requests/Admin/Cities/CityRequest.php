<?php

namespace App\Http\Requests\Admin\Cities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class CityRequest extends FormRequest
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
            'ip' => ['nullable', 'max:255'],
            'rp' => ['nullable', 'max:255'],
            'dp' => ['nullable', 'max:255'],
            'vp' => ['nullable', 'max:255'],
            'tp' => ['nullable', 'max:255'],
            'mp' => ['nullable', 'max:255'],
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
            'ip' => 'IP',
            'rp' => 'RP',
            'dp' => 'DP',
            'vp' => 'VP',
            'tp' => 'TP',
            'mp' => 'MP',
        ];
    }
}

