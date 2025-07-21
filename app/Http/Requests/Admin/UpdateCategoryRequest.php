<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        $categoryId = request()->route('category') ? request()->route('category')->id : null;

        return [
            'category' => ['required', 'unique:categories,name,' . $categoryId]
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
            'category.required' => __('messages.category_name_required'),
            'category.unique' => __('messages.category_name_unique'),
        ];
    }
}
