<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaySlipHistory;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RejectOrderRequest;
use App\Http\Requests\Admin\UpdateOrderStatusRequest;

class OrderBoardController extends Controller
{
    public function __construct(protected OrderService $orderService) {}

    // عرض كل الطلبات
    public function index()
    {
        $orders = $this->orderService->getOrdersWithDetails();
        return view('admin.orderBoard.list', compact('orders'));
    }

    // عرض تفاصيل الطلب
    public function show($orderCode)
    {
        $order = $this->orderService->getOrderDetailsData($orderCode);
        $paySlipData = $order->paySlipHistory->first();
        return view('admin.orderBoard.details', compact('order', 'paySlipData'));
    }

    // حذف الطلب
    public function destroy(Order $order)
    {
        $this->orderService->deleteOrder($order);
        return back();
    }


    public function changeStatus(Request $request){
        $result = $this->orderService->changeStatus($request->orderCode, $request->status);
        if($result){
            return response()->json(['success' => $result]);
        }else{
            return response()->json(['error' => 'Order not found']);
        }
    }


    public function updateStatus(UpdateOrderStatusRequest $request) {
        $result = $this->orderService->updateStatus($request->id, $request->status);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 404);
        }
        return response()->json(['success' => $result['success']]);
    }

    // For reject option, need to provide a reason
    public function rejectOrder(RejectOrderRequest $request) {
        $result = $this->orderService->rejectOrder($request->order_code, $request->reason);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 404);
        }
        return response()->json(['success' => $result['success']]);
    }

    // In case admin chose "Reject" but wants to change it back
    public function removeRejectReason(Request $request) {
        $result = $this->orderService->removeRejectReason($request->order_code, $request->status);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 404);
        }
        return response()->json(['success' => $result['success']]);
    }


}
