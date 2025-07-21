<?php

namespace App\Services;

use App\Models\Order;
use App\Interfaces\OrderRepositoryInterface;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAll();
    }

    public function getOrderById($id)
    {
        return $this->orderRepository->findById($id);
    }

    public function createOrder(array $data)
    {
        return $this->orderRepository->create($data);
    }

    public function updateOrder(Order $order, array $data)
    {
        return $this->orderRepository->update($order, $data);
    }

    public function deleteOrder(Order $order)
    {
        return $this->orderRepository->delete($order);
    }

    public function getOrdersWithDetails()
    {
        return $this->orderRepository->getOrdersWithDetails();
    }

    public function getOrderDetailsData($orderCode)
    {
        $order = $this->orderRepository->getOrderDetailsByCode($orderCode);
        return $order;
    }

    public function changeStatus($orderCode, $status)
    {
        return $this->orderRepository->changeStatus($orderCode, $status);
    }

    public function updateStatus($orderCode, $status)
    {
        $order = $this->orderRepository->updateStatus($orderCode, $status);
        if (!$order) {
            return ['error' => 'Order not found'];
        }
        return ['success' => 'Order status updated successfully!'];
    }

    public function rejectOrder($orderCode, $reason)
    {
        $order = $this->orderRepository->rejectOrder($orderCode, $reason);
        if (!$order) {
            return ['error' => 'Order not found'];
        }
        return ['success' => 'Order rejected with reason'];
    }

    public function removeRejectReason($orderCode, $status)
    {
        $order = $this->orderRepository->removeRejectReason($orderCode, $status);
        if (!$order) {
            return ['error' => 'Order not found'];
        }
        return ['success' => 'Order status updated, reject reason removed'];
    }
}
