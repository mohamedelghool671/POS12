<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangeUserPasswordRequest extends FormRequest
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
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
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
            'oldPassword.required' => __('messages.user_old_password_required'),
            'newPassword.required' => __('messages.user_new_password_required'),
            'confirmPassword.required' => __('messages.user_confirm_password_required'),
            'confirmPassword.same' => __('messages.user_confirm_password_same'),
        ];
    }
}
