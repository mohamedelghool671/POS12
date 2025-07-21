<?php

namespace App\Services;

use App\Interfaces\SaleRepositoryInterface;

class SaleService
{
    protected $saleRepository;

    public function __construct(SaleRepositoryInterface $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function getSalesReport($startDate, $endDate)
    {
        return $this->saleRepository->getSalesReport($startDate, $endDate);
    }

    public function getProductReport($startDate, $endDate)
    {
        return $this->saleRepository->getProductReport($startDate, $endDate);
    }

    public function getProfitLossReport($startDate, $endDate)
    {
        return $this->saleRepository->getProfitLossReport($startDate, $endDate);
    }

    public function getTodayOrders()
    {
        return $this->saleRepository->getTodayOrders();
    }
}
