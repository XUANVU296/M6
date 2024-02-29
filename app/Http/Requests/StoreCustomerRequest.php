<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'email' =>'required|email|unique:customers,email',
            'phone' =>'required|unique:customers',
        ];
    }
    public function message(): array
    {
        return [
            'name.required' => 'Tên khác hàng không được để trống',
            'email.required' => 'Email khách hàng không được không được để trống',
            'email.unique' => 'Email này đã tồn tại trên hệ thống',
            'phone.required' => 'Số điện thoại khách hàng không được để trống',
            'phone.unique' => 'Số điện thoại này đã tồn tại trên hệ thống',
        ];
    }
}