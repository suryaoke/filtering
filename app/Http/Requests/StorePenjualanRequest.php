<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenjualanRequest extends FormRequest
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
            'nama_perusahaan' => ['required', 'string', 'max:255'],
            'nama_kontak'     => ['required', 'string', 'max:255'],
            'email'           => ['nullable', 'email', 'max:255'],
            'telepon'         => ['nullable', 'string', 'max:50'],
            'industri'        => ['nullable', 'string', 'max:255'],
            'sumber_data'     => ['nullable', 'string', 'max:255'],
            'status_filter'   => ['nullable', 'string', 'in:baru,dihubungi,prospek,negosiasi,menang,kalah,pending'],
            'tanggal_input'   => ['nullable', 'date'],
            'user_id'         => ['required', 'exists:users,id'],
        ];
    }

    /**
     * Get custom attribute names for error messages.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nama_perusahaan' => 'Nama Perusahaan',
            'nama_kontak'     => 'Nama Kontak',
            'email'           => 'Email',
            'telepon'         => 'Telepon',
            'industri'        => 'Industri',
            'sumber_data'     => 'Sumber Data',
            'status_filter'   => 'Status',
            'tanggal_input'   => 'Tanggal Input',
            'user_id'         => 'User',
        ];
    }
}
