<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Models\PaySlipHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Interfaces\ShopRepositoryInterface;

class ShopRepository implements ShopRepositoryInterface
{
    public function getProducts($category_id = null, $filters = [])
    {
        $products = Product::with(['category', 'comments', 'ratings', 'discounts', 'carts']);
        if(isset($filters['searchKey'])) {
            $products->where('name','like','%'.$filters['searchKey'].'%');
        }
        if(isset($filters['minPrice']) && isset($filters['maxPrice'])) {
            $products->whereBetween('price', [$filters['minPrice'], $filters['maxPrice']]);
        } elseif(isset($filters['minPrice'])) {
            $products->where('price','>=', $filters['minPrice']);
        } elseif(isset($filters['maxPrice'])) {
            $products->where('price','<=', $filters['maxPrice']);
        }
        if($category_id != null){
            $products->where('category_id',$category_id);
        }
        $products = $products->paginate(9);
        $categories = Category::all();
        return compact('products', 'categories');
    }

    public function getProductDetails($id)
    {
        $product = Product::with(['category', 'comments.user', 'ratings', 'orders' => function($q){ $q->where('status', 1); }])
            ->findOrFail($id);
        $remaining_stock = $product->count - $product->orders->sum('count');
        $productRating = $product->ratings->avg('count');
        $ratingCount = $product->ratings;
        $user_Rating = $product->ratings->where('user_id', Auth::id())->first();
        $user_Rating = $user_Rating ? $user_Rating->count : 0;
        $productList = Product::with('category')->get();
        $topProducts = Product::withCount(['orders as total_sold' => function($q){ $q->select(DB::raw('SUM(count)')); }])
            ->orderByDesc('total_sold')
            ->take(3)
            ->get();
        $bestProduct = $product;
        $comment = $product->comments;
        return compact('product','comment','productRating','ratingCount','user_Rating','productList','bestProduct','topProducts','remaining_stock');
    }

    public function addComment(array $data)
    {
        return Comment::create($data);
    }

    public function addRating(array $data)
    {
        $ratingCheckData = Rating::where('product_id',$data['product_id'])->where('user_id',$data['user_id'])->first();
        if ($ratingCheckData == null) {
            return Rating::create([
                'product_id' =>$data['product_id'],
                'user_id' =>$data['user_id'],
                'count' =>$data['count']
            ]);
        } else {
            return Rating::where('product_id',$data['product_id'])->where('user_id',$data['user_id'])->update([
                'count' => $data['count']
            ]);
        }
    }

    public function getCart($userId)
    {
        $cart = Cart::with('product')->where('user_id',$userId)->get();
        $totalPrice = $cart->sum(function($item){
            return $item->product ? $item->product->price * $item->qty : 0;
        });
        $payment = Payment::all();
        return compact('cart','totalPrice','payment');
    }

    public function addToCart(array $data)
    {
        return Cart::create($data);
    }

    public function removeCart($cartId)
    {
        return Cart::where('id',$cartId)->delete();
    }

    public function makeOrder(array $orderArr)
    {
        Session::put('orderList', $orderArr);
        return true;
    }

    public function getOrderList($userId)
    {
        return Order::where('user_id',$userId)
                        ->orderBy('created_at','desc')
                        ->groupBy('order_code')
                        ->get();
    }

    public function customerOrders($orderCode)
    {
        return Order::with('product')
            ->where('order_code',$orderCode)
            ->paginate(2);
    }

    public function userPayment($userId)
    {
        $orderProduct = Session::get('orderList');
        $payment = Payment::orderBy('type','asc')->get();
        $total = 0;
        foreach($orderProduct as $item){
            $total += $item['total_price'];
        }
        return compact('payment','total','orderProduct');
    }

    public function orderProduct(array $data)
    {
        try {
            Log::info('ShopRepository orderProduct called with data:', $data);

            $cartProduct = Session::get('orderList');

            if (!$cartProduct) {
                Log::error('No orderList in session');
                return false;
            }

            Log::info('Cart products from session:', $cartProduct);

            foreach($cartProduct as $item){
                $product = Product::find($item['product_id']);
                if(!$product){
                    Log::error('Product not found: ' . $item['product_id']);
                    return false;
                }

                // إنشاء الطلب
                $orderData = [
                    'product_id' => $item['product_id'],
                    'user_id' => Auth::user()->id,
                    'status' => 0, // معلق
                    'order_code' => $item['order_code'],
                    'count' => $item['qty'] ?? 1,
                    'totalPrice' => ($item['qty'] ?? 1) * $product->price
                ];

                Log::info('Creating order with data:', $orderData);
                Order::create($orderData);

                // حذف من السلة
                Cart::where('user_id', Auth::user()->id)
                    ->where('product_id', $item['product_id'])
                    ->delete();
            }

            // إنشاء سجل إيصال الدفع
            $paySlipData = [
                'user_id' => Auth::id(),
                'phone' => $data['phone'] ?? '',
                'payment_method_id' => $data['paymentMethod'] ?? null,
                'order_id' => Order::latest()->first()?->id,
                'order_amount' => $data['totalAmount'] ?? 0,
            ];

            // رفع صورة الإيصال إذا وجدت
            if(isset($data['paySlipImage']) && $data['paySlipImage']){
                $fileName = uniqid() . $data['paySlipImage']->getClientOriginalName();
                $data['paySlipImage']->move(public_path(). '/payslipRecords/' , $fileName);
                $paySlipData['payslip_image'] = $fileName;
            }

            Log::info('Creating PaySlipHistory with data:', $paySlipData);
            PaySlipHistory::create($paySlipData);

            // مسح البيانات من الجلسة
            Session::forget('orderList');

            Log::info('Order created successfully');
            return true;

        } catch (\Exception $e) {
            Log::error('Error in orderProduct: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    public function getCategories()
    {
        return \App\Models\Category::get();
    }
}
