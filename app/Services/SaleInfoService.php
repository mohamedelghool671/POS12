<?php

namespace App\Services;

use App\Interfaces\SaleInfoRepositoryInterface;

class SaleInfoService
{
    protected $saleInfoRepository;

    public function __construct(SaleInfoRepositoryInterface $saleInfoRepository)
    {
        $this->saleInfoRepository = $saleInfoRepository;
    }

    public function getSalesReport($startDate, $endDate)
    {
        return $this->saleInfoRepository->getSalesReport($startDate, $endDate);
    }

    public function getProductReport($startDate, $endDate)
    {
        return $this->saleInfoRepository->getProductReport($startDate, $endDate);
    }

    public function getProfitLossReport($startDate, $endDate)
    {
        return $this->saleInfoRepository->getProfitLossReport($startDate, $endDate);
    }

    public function getTodayOrders()
    {
        return $this->saleInfoRepository->getTodayOrders();
    }
}
