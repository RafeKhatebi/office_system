<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'client_id'         => 'required|exists:clients,id',
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'project_type'      => 'nullable|string|max:255',
            'status'            => 'required|in:pending,in_progress,completed,cancelled',
            'priority'          => 'required|in:low,medium,high',
            'start_date'        => 'required|date',
            'expected_end_date' => 'nullable|date',
            'actual_end_date'   => 'nullable|date',
        ];
    }
}
