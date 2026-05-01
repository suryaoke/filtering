<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('product');
        return [
            'name'        => 'sometimes|required|string|max:255',
            'sku'         => 'sometimes|required|string|unique:products,sku,' . $id . '|max:100',
            'description' => 'nullable|string',
            'price'       => 'sometimes|required|numeric|min:0',
            'stock'       => 'sometimes|required|integer|min:0',
            'category'    => 'nullable|string|max:100',
            'is_active'   => 'boolean',
        ];
    }
}
