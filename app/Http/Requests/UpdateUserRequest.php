<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        'email' => 'required|email|unique:users,email,'.$this->id,
        'phone' => 'required|numeric|unique:users,phone,'.$this->id.'',
    ];
}

public function messages(): array
{
    return [
        'name.required' => 'Tên không được để trống.',
        'email.required' => 'Email không được để trống.',
        'email.email' => 'Email không đúng định dạng.',
        'email.unique' => 'Email này đã tồn tại trên hệ thống.',
        'phone.required' => 'Số điện thoại không được để trống.',
        'phone.numeric' => 'Số điện thoại phải là số.',
        'phone.unique' => 'Số điện thoại này đã tồn tại trên hệ thống.',
    ];
}
}