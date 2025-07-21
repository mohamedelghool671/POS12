<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Report;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\UserDashboardRepositoryInterface;

class UserDashboardRepository implements UserDashboardRepositoryInterface
{
    public function getDashboardData()
    {
        $category = Category::get();
        $products = Product::select('products.*','categories.name as category_name')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->get();
        $customerCount = User::where('role','user')->count();
        $rating = Rating::select('ratings.count','users.name','users.nickname','users.profile','ratings.created_at')
                            ->leftJoin('users','ratings.user_id','users.id')
                            ->orderBy('created_at','desc')
                            ->get();
        $order =  Order::select('products.name', 'products.price', 'products.image','products.id')
                        ->selectRaw('SUM(orders.count) as total_sales')
                        ->leftJoin('products', 'orders.product_id', 'products.id')
                        ->groupBy('products.id')
                        ->orderBy('total_sales', 'desc')
                        ->limit(3)
                        ->get();
        return compact('category','products','customerCount','rating','order');
    }

    public function updateProfile(User $user, array $data)
    {
        // معالجة رفع الصورة
        if(isset($data['image']) && $data['image'] != null && $data['image']->isValid()){
            // حذف الصورة القديمة
            $oldImageName = $data['oldImage'] ?? null;
            if($oldImageName != null && $oldImageName != ''){
                $oldImagePath = public_path('userProfile/'.$oldImageName);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
            // رفع الصورة الجديدة
            $fileName = uniqid() . '_' . $data['image']->getClientOriginalName();
            $data['image']->move(public_path('userProfile'), $fileName);
            $data['profile'] = $fileName;
        } else {
            $data['profile'] = $data['oldImage'] ?? null;
        }

        // إزالة الحقول غير المطلوبة من البيانات
        unset($data['image'], $data['oldImage']);
        
        return $user->update($data);
    }

    public function changeUserPassword(User $user, $newPassword)
    {
        $user->password = Hash::make($newPassword);
        $user->save();
        return $user;
    }

    public function sendMessage(User $user, array $data)
    {
        return $user->reports()->create($data);
    }
}
