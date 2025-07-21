<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'unique:products,name'],
            'price' => 'required|numeric',
            'purchaseprice' => 'required|numeric',
            'categoryName' => 'required|exists:categories,id',
            'count' => ['required', 'integer', 'max:100'],
            'description' => 'required',
            'image' => ['required', 'mimes:png,jpeg,svg,gif,bmp,webp'],
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
            'name.required' => __('messages.product_name_required'),
            'name.unique' => __('messages.product_name_unique'),
            'price.required' => __('messages.product_price_required'),
            'price.numeric' => __('messages.product_price_numeric'),
            'purchaseprice.required' => __('messages.product_purchase_price_required'),
            'purchaseprice.numeric' => __('messages.product_purchase_price_numeric'),
            'categoryName.required' => __('messages.product_category_required'),
            'categoryName.exists' => __('messages.product_category_exists'),
            'count.required' => __('messages.product_count_required'),
            'count.integer' => __('messages.product_count_integer'),
            'count.max' => __('messages.product_count_max'),
            'description.required' => __('messages.product_description_required'),
            'image.required' => __('messages.product_image_required'),
            'image.mimes' => __('messages.product_image_mimes'),
        ];
    }
}
