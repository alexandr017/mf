<?php

namespace App\Http\Requests\Admin\Reports;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;
use App\Models\Reports\ReportCategory;

class ReportRequest extends FormRequest
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
        $reportId = $this->route('report') ?? $this->route('id') ?? null;

        $rules = [
            'reported_user_id' => ['required', 'exists:users,id'],
            'category_id' => ['required', 'integer', 'in:' . implode(',', array_keys(ReportCategory::getAll()))],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'string', 'in:pending,reviewed,resolved,rejected'],
        ];

        if ($reportId) {
            // При редактировании
            $rules['reported_user_id'] = ['sometimes', 'exists:users,id'];
            $rules['category_id'] = ['sometimes', 'integer', 'in:' . implode(',', array_keys(ReportCategory::getAll()))];
            $rules['admin_notes'] = ['nullable', 'string', 'max:2000'];
        } else {
            // При создании
            $rules['reporter_user_id'] = ['nullable', 'exists:users,id'];
            $rules['reporter_email'] = ['nullable', 'email', 'max:255'];
        }

        return $rules;
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'reported_user_id' => 'Пользователь, на которого жалуются',
            'reporter_user_id' => 'Пользователь, который жалуется',
            'reporter_email' => 'Email жалобщика',
            'category_id' => 'Категория нарушения',
            'description' => 'Описание',
            'status' => 'Статус',
            'admin_notes' => 'Заметки администратора',
        ];
    }
}


