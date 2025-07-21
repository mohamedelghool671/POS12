<?php

namespace App\Repositories;

use App\Models\Order;
use App\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAll()
    {
        return Order::with(['user', 'product'])
            ->orderBy('id')
            ->paginate(10);
    }

    public function findById($id)
    {
        return Order::findOrFail($id);
    }

    public function create(array $data)
    {
        return Order::create($data);
    }

    public function update(Order $order, array $data)
    {
        $order->update($data);
        return $order;
    }

    public function delete(Order $order)
    {
        return $order->delete();
    }

    public function getOrdersWithDetails()
    {
        $today = \Carbon\Carbon::today();
        return Order::with(['user', 'product'])
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->groupBy('order_code')
            ->paginate(3);
    }

    public function getOrderDetailsByCode($orderCode)
    {
        return Order::with(['product','user','paySlipHistory'])
            ->firstWhere('order_code',$orderCode);
    }

    public function changeStatus($orderCode, $status)
    {
        return Order::where('order_code', $orderCode)->update(['status' => $status]);
    }

    public function updateStatus($orderCode, $status)
    {
        $order = Order::where('order_code', $orderCode)->first();
        if (!$order) return false;
        $order->status = $status;
        if ($order->status != 2) {
            $order->reject_reason = null;
        }
        $order->save();
        return $order;
    }

    public function rejectOrder($orderCode, $reason)
    {
        $order = Order::where('order_code', $orderCode)->first();
        if (!$order) return false;
        $order->status = 2;
        $order->reject_reason = $reason;
        $order->save();
        return $order;
    }

    public function removeRejectReason($orderCode, $status)
    {
        $order = Order::where('order_code', $orderCode)->first();
        if (!$order) return false;
        $order->status = $status;
        $order->reject_reason = null;
        $order->save();
        return $order;
    }
}
