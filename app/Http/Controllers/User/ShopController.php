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
        try {
            $data = [
                'user_id' => Auth::user()->id,
                'product_id' => $request->productID,
                'qty' => $request->qty,
            ];
            $this->shopService->addToCart($data);
            Alert::success(
                __('messages.added_success'),
                __('messages.product_added_to_cart')
            );
            return back();
        } catch (\Exception $e) {
            Alert::error(
                __('messages.add_failed'),
                __('messages.add_failed_message')
            );
            return back();
        }
    }

    public function removeCart(Request $request)
    {
        try {
            $this->shopService->removeCart($request->cartId);
    
            return response()->json([
                'status' => 200,
                'message' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'error',
                'alert' => [
                    'icon' => 'error',
                    'title' => __('messages.delete_failed'),
                    'text' => __('messages.delete_failed_message'),
                ]
            ]);
        }
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
                Alert::error(__('messages.order_failed_title'), __('messages.order_failed_message'));
                return back();
            }

            $data = $request->all();
            $result = $this->shopService->orderProduct($data);

            if ($result) {
                Alert::success(__('messages.order_success_title'), __('messages.order_success_message'));
                return redirect()->route('shopList');
            } else {
                Alert::error(__('messages.order_failed_title'), __('messages.order_failed_message'));
                return back();
            }

        } catch (\Exception $e) {
            Log::error('Payment Error: ' . $e->getMessage());
            Alert::error(__('messages.error'), __('messages.something_went_wrong'));
            return back();
        }
    }
}


