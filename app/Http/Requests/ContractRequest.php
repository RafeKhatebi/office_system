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
        return [
            'project_id'      => 'required|exists:projects,id',
            'contract_number' => 'required|string',
            'amount'          => 'required|numeric|min:1',
            'currency'        => 'required|in:AF,USD',
            'payment_type'    => 'required|in:full,installment',
            'signed_date'     => 'signed_date|date',
            'status'          => 'required|in:active,expired,terminated',
            'contract_file'   => 'nullable|string',
            'notes'           => 'nullable|string',
            ''
        ];
    }
}
