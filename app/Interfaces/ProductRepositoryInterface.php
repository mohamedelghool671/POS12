<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update(Product $product, array $data);
    public function delete(Product $product);
    public function getList($searchKey = null);
    public function getDetails($id);
    public function getEditData($id);
}
