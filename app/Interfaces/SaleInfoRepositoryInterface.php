<?php

namespace App\Interfaces;

interface SaleInfoRepositoryInterface
{
    public function getSalesReport($startDate, $endDate);
    public function getProductReport($startDate, $endDate);
    public function getProfitLossReport($startDate, $endDate);
    public function getTodayOrders();
}
