<?php

namespace App\Interfaces;

interface ShopRepositoryInterface
{
    public function getProducts($category_id = null, $filters = []);
    public function getProductDetails($id);
    public function addComment(array $data);
    public function addRating(array $data);
    public function getCart($userId);
    public function addToCart(array $data);
    public function removeCart($cartId);
    public function makeOrder(array $orderArr);
    public function getOrderList($userId);
    public function customerOrders($orderCode);
    public function userPayment($userId);
    public function orderProduct(array $data);
    public function getCategories();
}
