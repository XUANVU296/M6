<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' =>'required',
            'email' =>'required|email|unique:users,email',
            'phone' =>'required|numeric|unique:users,phone',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Không được để trống trượng này',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email này đã tồn tại',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Bắt buộc phải nhập số',
            'phone.unique' => 'Số điện thoại này đã tồn tại trên hệ thống'
        ];
    }
}
