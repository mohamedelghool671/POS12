<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'paymentMethod' => 'required',
            'paySlipImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'orderCode' => 'required|string',
            'totalAmount' => 'required|numeric|min:0',
        ];

        // فاليديشن خاص بفودافون كاش
        if ($this->input('paymentMethod') === 'VodafoneCash') {
            $rules['phone'] = [
                'required',
                'regex:/^(010|011|012|015)[0-9]{8}$/',
            ];
        }
        // يمكنك إضافة فاليديشن مخصص لأي وسيلة دفع أخرى هنا

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
            'name.required' => __('messages.name_required'),
            'name.string' => __('messages.name_must_be_string'),
            'name.max' => __('messages.name_too_long'),
            'phone.required' => __('messages.phone_required'),
            'phone.string' => __('messages.phone_must_be_string'),
            'phone.max' => __('messages.phone_too_long'),
            'phone.regex' => __('messages.vodafone_cash_phone_invalid'),
            'paymentMethod.required' => __('messages.payment_method_required'),
            'paySlipImage.image' => __('messages.pay_slip_must_be_image'),
            'paySlipImage.mimes' => __('messages.pay_slip_invalid_format'),
            'paySlipImage.max' => __('messages.pay_slip_too_large'),
            'orderCode.required' => __('messages.order_code_required'),
            'totalAmount.required' => __('messages.total_amount_required'),
            'totalAmount.numeric' => __('messages.total_amount_must_be_number'),
            'totalAmount.min' => __('messages.total_amount_invalid'),
        ];
    }
}
