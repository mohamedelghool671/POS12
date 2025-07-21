<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $rules = [
            'phone' => ['required', 'unique:users,phone,' . Auth::user()->id],
            'address' => 'required',
        ];

        if (Auth::user()->provider == 'simple') {
            $rules['name'] = 'required';
            $rules['email'] = 'required|unique:users,email,' . Auth::user()->id;
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => __('messages.profile_name_required'),
            'email.required' => __('messages.profile_email_required'),
            'email.unique' => __('messages.profile_email_unique'),
            'phone.required' => __('messages.profile_phone_required'),
            'phone.unique' => __('messages.profile_phone_unique'),
            'address.required' => __('messages.profile_address_required'),
        ];
    }
}
