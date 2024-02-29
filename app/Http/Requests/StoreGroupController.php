<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupController extends FormRequest
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
            'name' => 'required|unique:groups,name',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Không được để trống trường này',
            'name.unique' => 'Chức vụ này đã tồn tại trên hệ thống',
        ];
    }
}
