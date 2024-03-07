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
            'name' => 'required|numeric:products',
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
            'name.required' => 'Trường bắt buộc nhập.',
            'name.numeric' => 'Tên sản phẩm đã tồn tại.',
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
