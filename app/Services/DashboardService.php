<?php

namespace App\Services;

use App\Interfaces\DashboardRepositoryInterface;

class DashboardService
{
    protected $dashboardRepository;

    public function __construct(DashboardRepositoryInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getDashboardStats()
    {
        return $this->dashboardRepository->getDashboardStats();
    }

    public function getSalesOverview()
    {
        return $this->dashboardRepository->getSalesOverview();
    }

    public function getTopProducts()
    {
        return $this->dashboardRepository->getTopProducts();
    }

    public function getStockInfo()
    {
        return $this->dashboardRepository->getStockInfo();
    }

    public function getOutOfStock($stock)
    {
        return $this->dashboardRepository->getOutOfStock($stock);
    }

    public function getPendingOrders()
    {
        return $this->dashboardRepository->getPendingOrders();
    }
}
