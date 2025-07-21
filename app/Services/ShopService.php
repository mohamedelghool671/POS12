<?php

namespace App\Services;

use App\Interfaces\ShopRepositoryInterface;

class ShopService
{
    protected $shopRepository;

    public function __construct(ShopRepositoryInterface $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    public function getProducts($category_id = null, $filters = [])
    {
        return $this->shopRepository->getProducts($category_id, $filters);
    }

    public function getProductDetails($id)
    {
        return $this->shopRepository->getProductDetails($id);
    }

    public function addComment(array $data)
    {
        return $this->shopRepository->addComment($data);
    }

    public function addRating(array $data)
    {
        return $this->shopRepository->addRating($data);
    }

    public function getCart($userId)
    {
        return $this->shopRepository->getCart($userId);
    }

    public function addToCart(array $data)
    {
        return $this->shopRepository->addToCart($data);
    }

    public function removeCart($cartId)
    {
        return $this->shopRepository->removeCart($cartId);
    }

    public function makeOrder(array $orderArr)
    {
        return $this->shopRepository->makeOrder($orderArr);
    }

    public function getOrderList($userId)
    {
        return $this->shopRepository->getOrderList($userId);
    }

    public function customerOrders($orderCode)
    {
        return $this->shopRepository->customerOrders($orderCode);
    }

    public function userPayment($userId)
    {
        return $this->shopRepository->userPayment($userId);
    }

    public function orderProduct(array $data)
    {
        return $this->shopRepository->orderProduct($data);
    }

    public function getCategories()
    {
        return $this->shopRepository->getCategories();
    }
}
