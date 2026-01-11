<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    /*Determine if the user is authorized to make this request*/
    public function authorize(): bool
    {
        return true;
    }

    /* Get the validation rules that apply to the request. */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:fixed,variable',
            'expense_date' => 'required|date',
            'payment_type' => 'required|in:cash,bank',
            'frequency' => 'required_if:type,fixed|in:monthly,yearly',
            'start_date' => 'required_if:type,fixed|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'note' => 'nullable|string',
        ];
    }

    /* Prepare the data for validation.*/
    protected function prepareForValidation(): void
    {
        if ($this->input('type') === 'variable') {
            $this->merge([
                'frequency' => null,
                'start_date' => null,
                'end_date' => null,
            ]);
        }
    }
}
