<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\ShopService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\User\CommentRequest;
use App\Http\Requests\User\PaymentRequest;

class ShopController extends Controller
{
    protected $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function shop($category_id = null)
    {
        $filters = [
            'searchKey' => request('searchKey'),
            'minPrice' => request('minPrice'),
            'maxPrice' => request('maxPrice'),
        ];
        $result = $this->shopService->getProducts($category_id, $filters);
        $products = $result['products'];
        $categories = $result['categories'];
        return view('user.shop', compact('products', 'categories'));
    }

    public function details($id)
    {
        $data = $this->shopService->getProductDetails($id, Auth::user()->id);
        return view('user.details', $data);
    }

    public function comment(CommentRequest $request)
    {
        $data = [
            'product_id' => $request->productID,
            'user_id' => $request->userID,
            'message' => $request->message,
        ];
        $this->shopService->addComment($data);
        Alert::success(__('messages.comment_success_title'), __('messages.comment_success_message'));
        return back();
    }

    public function addRating(Request $request)
    {
        $data = [
            'product_id' => $request->productID,
            'user_id' => $request->userID,
            'count' => $request->productRating
        ];
        $this->shopService->addRating($data);
        Alert::success(__('messages.rating_success_title'), __('messages.rating_success_message'));
        return back();
    }

    public function cart()
    {
        $userId = Auth::user()->id;
        $cartData = $this->shopService->getCart($userId);
        return view('user.cart', $cartData);
    }

    public function addToCart(Request $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'product_id' => $request->productID,
            'qty' => $request->qty,
        ];
        $this->shopService->addToCart($data);
        return back();
    }

    public function removeCart(Request $request)
    {
        $this->shopService->removeCart($request->cart_id);
        return back();
    }

    public function order(Request $request)
    {
        $orderArr = $request->all();
        $this->shopService->makeOrder($orderArr);
        return response()->json([
            "message" => __('messages.order_success'),
            "status" => 200
        ], 200);
    }

    public function orderList()
    {
        $userId = Auth::user()->id;
        $orders = $this->shopService->getOrderList($userId);
        return view('user.orderList', compact('orders'));
    }

    public function customerOrders($orderCode)
    {
        $orders = $this->shopService->customerOrders($orderCode);
        return view('user.userOrderDetails', compact('orders'));
    }

    public function userPayment()
    {
        $userId = Auth::user()->id;
        $paymentData = $this->shopService->userPayment($userId);
        return view('user.payment', [
            'payments' => $paymentData['payment'],
            'total' => $paymentData['total'],
            'orderProduct' => $paymentData['orderProduct'],
        ]);
    }

    public function orderProduct(\App\Http\Requests\User\PaymentRequest $request)
    {
        try {
            // طباعة البيانات للـ debug
            Log::info('Payment Data Received:', $request->all());

            // التحقق من البيانات الأساسية
            if (!$request->name || !$request->phone || !$request->paymentMethod) {
                Alert::error('خطأ', 'يرجى ملء جميع الحقول المطلوبة');
                return back();
            }

            $data = $request->all();
            $result = $this->shopService->orderProduct($data);

            if ($result) {
                Alert::success('نجح الطلب', 'تم إرسال طلبك بنجاح');
                return redirect()->route('shopList');
            } else {
                Alert::error('فشل الطلب', 'حدث خطأ أثناء إرسال الطلب');
                return back();
            }

        } catch (\Exception $e) {
            Log::error('Payment Error: ' . $e->getMessage());
            Alert::error('خطأ', 'حدث خطأ غير متوقع');
            return back();
        }
    }
}


