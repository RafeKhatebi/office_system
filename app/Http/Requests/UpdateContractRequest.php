<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractRequest extends FormRequest
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
            'project_id'      => 'sometimes|exists:projects,id',
            'amount'          => 'sometimes|numeric|min:1',
            'currency'        => 'sometimes|in:AFN,USD',
            'payment_type'    => 'sometimes|in:full,installment',
            'signed_date'     => 'sometimes|date',
            'status'          => 'sometimes|in:active,expired,terminated',
            'contract_file'   => 'sometimes|file|mimes:pdf,doc,docx|max:5120',
            'notes'           => 'sometimes|string|max:1000'
        ];
    }
}
