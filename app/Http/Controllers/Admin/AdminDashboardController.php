<?php

namespace App\Http\Controllers\Admin;

use App\Services\DashboardService;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $stats = $this->dashboardService->getDashboardStats();
        $salesOverview = $this->dashboardService->getSalesOverview();
        $topProducts = $this->dashboardService->getTopProducts();
        $stock = $this->dashboardService->getStockInfo();
        $outofstock = $this->dashboardService->getOutOfStock($stock);
        $pendingOrders = $this->dashboardService->getPendingOrders();
        return view('admin.home', array_merge($stats,get_defined_vars()));
    }
}
