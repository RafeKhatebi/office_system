<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
        $rules = [
            'project_id'    => 'required|exists:projects,id',
            'amount'        => 'required|numeric|min:1',
            'currency'      => 'required|in:AFN,USD',
            'payment_type'  => 'required|in:full,installment',
            'signed_date'   => 'required|date',
            'status'        => 'required|in:active,expired,terminated',
            'contract_file' => 'nullable|file|mimes:pdf,doc,docx',
            'notes'         => 'nullable|string|max:1000',
        ];

        // اگر update بود (PUT / PATCH)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            foreach ($rules as $key => $rule) {
                $rules[$key] = str_replace('required', 'sometimes', $rule);
            }
        }

        return $rules;
    }

}
