<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Interfaces\SaleInfoRepositoryInterface;

class SaleInfoRepository implements SaleInfoRepositoryInterface
{
    public function getSalesReport($startDate, $endDate)
    {
        return Order::with('product')
            ->where('status', 1)
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->orderBy('id')
            ->get();
    }

    public function getProductReport($startDate, $endDate)
    {
        return Product::with(['category', 'orders' => function($q) use ($startDate, $endDate) {
                $q->whereDate('created_at', '>=', $startDate)
                  ->whereDate('created_at', '<=', $endDate);
            }])
            ->get();
    }

    public function getProfitLossReport($startDate, $endDate)
    {
        return Product::with(['orders' => function($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate, $endDate]);
            }])
            ->get();
    }

    public function getTodayOrders()
    {
        $today = \Carbon\Carbon::today();
        return Order::with(['user', 'product'])
            ->where('status', 1)
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }
}
