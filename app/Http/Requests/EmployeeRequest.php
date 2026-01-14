<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'job_title'    => 'required|string|max:255',
            'salary'       => 'nullable|numeric|min:0',
            'address'      => 'nullable|string',
            'phone'        => 'required|string|max:15',
            'emergency_phone' => 'nullable|string|max:15',
            'gender'          => 'nullable|in:male,female',
            'date_of_birth'   => 'nullable|date|before_or_equal:today',
             'national_id' => [
            'nullable',
            'string',
            'max:255',
            Rule::unique('employees', 'national_id')
                ->ignore($this->route('employee')) // یا id
        ],
            'employment_type' => 'required|in:full_time,part_time,project_base,contract',
            'status'          => 'nullable|in:active,inactive',
        ];
    }
}
