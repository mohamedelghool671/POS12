<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|same:password'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => __('messages.admin_name_required'),
            'email.required' => __('messages.admin_email_required'),
            'email.email' => __('messages.admin_email_valid'),
            'email.unique' => __('messages.admin_email_unique'),
            'password.required' => __('messages.admin_password_required'),
            'password.min' => __('messages.admin_password_min'),
            'confirmpassword.required' => __('messages.admin_confirm_password_required'),
            'confirmpassword.same' => __('messages.admin_confirm_password_same'),
        ];
    }
}
