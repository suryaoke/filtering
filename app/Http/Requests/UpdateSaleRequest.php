<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaleRequest extends FormRequest
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
            'company_name' => 'sometimes|required|string|max:255',
            'contact_name' => 'sometimes|required|string|max:255',
            'email'        => 'nullable|email|max:255',
            'phone'        => 'nullable|string|max:20',
            'industry'     => 'nullable|string|max:100',
            'source'       => 'nullable|string|max:100',
            'input_date'   => 'nullable|date',
            'user_id'      => 'sometimes|required|exists:users,id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'company_name' => 'Company Name',
            'contact_name' => 'Contact Name',
            'email'        => 'Email Address',
            'phone'        => 'Phone Number',
            'industry'     => 'Industry',
            'source'       => 'Source',
            'input_date'   => 'Input Date',
            'user_id'      => 'Sales Representative',
        ];
    }
}
