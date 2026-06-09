<?php

namespace App\Http\Requests\Education;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpecialityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isEditor();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code'          => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('education_specialities', 'code')
                    ->ignore($this->id),
            ],
            'spec_code'     => 'required|string|max:50',
            'name'          => 'required|string|max:255',
            'name_profile'  => 'nullable|string|max:255',
            'level'         => 'required|string',
            'courses'       => 'nullable|integer|min:1|max:6',
            'favorite'      => 'int',
            'show'          => 'int',
            'department_id' => 'int|nullable',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => "Поле обязательно",
            '*.unique' => "Поле должно быть уникальным",
        ];
    }

}
