<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'date' => 'required|date|before_or_equal:today',
            'total_amount' => 'required|numeric',
            'quantity' => 'required|numeric',
            'order_status' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'date.required' => 'Không được để trống trường này',
            'date.date' => 'Đầu vào không hợp lệ',
            'date.before_or_equal' => 'Ngày tạo đơn không hợp lệ',
            'total_amount.required' => 'Không được để trống trường này',
            'total_amount.numeric' => 'Bắt buộc phải là số',
            'quantity.required' => 'Không được để trống trường này',
            'quantity.numeric' => 'Bắt buộc phải là số',
            'order_status.required' => 'Không được để trống trường này'
        ];
    }
}
