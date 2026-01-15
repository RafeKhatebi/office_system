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
    // اگر درخواست create بود
    if ($this->isMethod('post')) {
        return [
            'project_id'   => 'required|exists:projects,id',
            'amount'       => 'required|numeric|min:1',
            'currency'     => 'required|in:AFN,USD',
            'payment_type' => 'required|in:full,installment',
            'signed_date'  => 'required|date',
            'status'       => 'required|in:active,expired,terminated',
            'contract_file'=> 'nullable|file|mimes:pdf,doc,docx',
            'notes'        => 'nullable|string|max:1000',

            // فقط برای قسطی
            'installments'            => 'required_if:payment_type,installment|array|min:1',
            'installments.*.amount'   => 'required_if:payment_type,installment|numeric|min:1',
            'installments.*.due_date' => 'required_if:payment_type,installment|date',
        ];
    }

    // اگر update بود
    return [
        'project_id'   => 'sometimes|exists:projects,id',
        'amount'       => 'sometimes|numeric|min:1',
        'currency'     => 'sometimes|in:AFN,USD',
        'payment_type' => 'sometimes|in:full,installment',
        'signed_date'  => 'sometimes|date',
        'status'       => 'sometimes|in:active,expired,terminated',
        'contract_file'=> 'nullable|file|mimes:pdf,doc,docx',
        'notes'        => 'nullable|string|max:1000',

        // در update، اقساط اختیاری‌اند
        'installments'            => 'sometimes|array|min:1',
        'installments.*.amount'   => 'sometimes|numeric|min:1',
        'installments.*.due_date' => 'sometimes|date',
    ];
}



}
