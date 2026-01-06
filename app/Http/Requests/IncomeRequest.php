<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomeRequest extends FormRequest
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
            'income_resource_id' => 'required|exists:income_resources,id',
            'title'              => 'required|string|max:255',
            'amount'             => 'required|numeric|min:0',
            'income_method'      => 'required|in:bank,cash',
            'income_date'        => 'required|date',
            'customer_name'      => 'nullable|string|max:255',
            'notes'              => 'nullable|string'
        ];
    }
}
