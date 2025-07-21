<?php

namespace App\Interfaces;

interface DashboardRepositoryInterface
{
    public function getDashboardStats();
    public function getSalesOverview();
    public function getTopProducts();
    public function getStockInfo();
    public function getOutOfStock($stock);
    public function getPendingOrders();
}
