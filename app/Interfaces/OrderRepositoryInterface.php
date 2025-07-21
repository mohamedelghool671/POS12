<?php

namespace App\Interfaces;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update(Order $order, array $data);
    public function delete(Order $order);
    public function getOrdersWithDetails();
    public function getOrderDetailsByCode($orderCode);
    public function changeStatus($orderCode, $status);
    public function updateStatus($orderCode, $status);
    public function rejectOrder($orderCode, $reason);
    public function removeRejectReason($orderCode, $status);
}
