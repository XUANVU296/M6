<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'name' => 'required',
            'email' =>'required|email|unique:customers,email,'.$this->customer.'',
            'phone' =>'required|numeric|unique:customers,phone,'.$this->customer.''
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Tên khách hàng không được để trống',
            'email.required' => 'Email khách hàng không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email này đã tồn tại trên hệ thống',
            'phone.required' => 'Số điện thoại khách hàng không được để trống',
            'phone.numeric' => 'Bắt buộc phải nhập số',
            'phone.unique' => 'Số điện thoại này đã tồn tại trên hệ thống'
        ];
    }
}
