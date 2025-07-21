<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\StorePaymentRequest;
use App\Http\Requests\Admin\UpdatePaymentRequest;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    // عرض كل وسائل الدفع
    public function index()
    {
        $data = $this->paymentService->paginate();
        return view('admin.payment.create', compact('data'));
    }

    // عرض فورم إضافة وسيلة دفع
    public function create()
    {
        return view('admin.payment.create');
    }

    // حفظ وسيلة دفع جديدة
    public function store(StorePaymentRequest $request)
    {
        $this->paymentService->store([
            'type' => $request->paymentType,
            'account_number' => $request->card_number,
            'account_name' => $request->cardholder_name,
        ]);
        Alert::success(__('messages.payment_success'), __('messages.payment_added_successfully'));
        return redirect()->route('payment.index');
    }

    // عرض فورم تعديل وسيلة دفع
    public function edit(Payment $payment)
    {
        return view('admin.payment.edit', compact('payment'));
    }

    // تحديث وسيلة دفع
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $this->paymentService->update($payment, [
            'type' => $request->paymentType,
            'account_number' => $request->card_number,
            'account_name' => $request->cardholder_name,
        ]);
        Alert::success(__('messages.update_success'), __('messages.payment_updated_successfully'));
        return redirect()->route('payment.index');
    }

    // حذف وسيلة دفع
    public function destroy(Payment $payment)
    {
        $this->paymentService->destroy($payment);
        Alert::success(__('messages.delete_success'), __('messages.payment_deleted_successfully'));
        return back();
    }

    // عرض تفاصيل وسيلة دفع واحدة (لو محتاج)
    public function show(Payment $payment)
    {
        return view('admin.payment.show', compact('payment'));
    }
}
