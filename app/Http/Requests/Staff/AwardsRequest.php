<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class AwardsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'staff_id' => ['required', 'exists:staffs'],
            'year' => ['nullable', 'integer'],
            'award' => ['required', 'string'],
            'order' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'staff_id.required' => "Поле обязательно",
            'award.required' => ['Поле обязательно'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->user()->isEditor();
    }
}
