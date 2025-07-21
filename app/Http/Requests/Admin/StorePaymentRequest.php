<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'paymentType' => 'required',
            'card_number' => 'required',
            'cardholder_name' => 'required',
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
            'paymentType.required' => __('messages.payment_type_required'),
            'card_number.required' => __('messages.payment_card_number_required'),
            'cardholder_name.required' => __('messages.payment_cardholder_name_required'),
        ];
    }
}
