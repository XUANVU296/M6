<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required:products',
            'description' => 'required:products',
            'price' => 'required|numeric:products',
            'quantity' => 'required|numeric:products',
            'status' => 'required:products',
            'category_id' => 'required:products',


        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường không được để trống.',
            'description.required' => 'Trường không được để trống.',
            'price.required' => 'Trường không được để trống.',
            'price.numeric' => 'Trường bắt buộc nhập số.',
            'quantity.required' => 'Trường không được để trống.',
            'quantity.numeric' => 'Trường bắt buộc nhập số.',
            'status.required' => 'Trường không được để trống.',
            'category_id.required' => 'Trường không được để trống.',


        ];
    }
}
