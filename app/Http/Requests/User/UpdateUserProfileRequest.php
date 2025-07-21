<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . Auth::user()->id],
            'phone' => ['sometimes', 'required', 'unique:users,phone,' . Auth::user()->id],
            'address' => ['sometimes', 'required'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,jpg,svg,gif,bmp,webp', 'max:2048'],
            'oldImage' => 'nullable'
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
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب أن يكون نصاً',
            'name.max' => 'الاسم لا يمكن أن يتجاوز 255 حرف',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.string' => 'البريد الإلكتروني يجب أن يكون نصاً',
            'email.lowercase' => 'البريد الإلكتروني يجب أن يكون بأحرف صغيرة',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.max' => 'البريد الإلكتروني لا يمكن أن يتجاوز 255 حرف',
            'email.unique' => 'البريد الإلكتروني موجود مسبقاً',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.unique' => 'رقم الهاتف موجود مسبقاً',
            'address.required' => 'العنوان مطلوب',
            'image.image' => 'الصورة يجب أن تكون صورة',
            'image.mimes' => 'الصورة يجب أن تكون من نوع: png, jpeg, jpg, svg, gif, bmp, webp',
            'image.max' => 'الصورة لا يمكن أن تتجاوز 2048 كيلوبايت',
            'oldImage.nullable' => 'الصورة القديمة مطلوبة إذا كانت هناك صورة قديمة',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'الاسم',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف',
            'address' => 'العنوان',
            'image' => 'الصورة',
            'oldImage' => 'الصورة القديمة',
        ];
    }
}
