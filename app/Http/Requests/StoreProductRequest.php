<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required:categories',
            'description' => 'required:categories',
            'price' => 'required|numeric:categories',
            'quantity' => 'required|numeric:categories',
            'status' => 'required:categories',
            'category_id' => 'required:categories',


        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường bắt buộc nhập.',
            'description.required' => 'Trường bắt buộc nhập.',
            'price.required' => 'Trường bắt buộc nhập.',
            'price.numeric' => 'Trường bắt buộc nhập số.',
            'quantity.required' => 'Trường bắt buộc nhập.',
            'quantity.numeric' => 'Trường bắt buộc nhập số.',
            'status.required' => 'Tên bắt buộc nhập.',
            'category_id.required' => 'Tên bắt buộc nhập.',


        ];
    }
}
