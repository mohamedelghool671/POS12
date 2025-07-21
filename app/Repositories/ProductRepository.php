<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::with(['category', 'comments', 'ratings', 'discounts', 'carts'])
            ->orderBy('id')
            ->paginate(3);
    }

    public function findById($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data)
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product)
    {
        return $product->delete();
    }

    public function getList($searchKey = null)
    {
        return Product::with(['category', 'comments', 'ratings', 'discounts', 'carts'])
            ->when($searchKey, function($query) use ($searchKey) {
                $query->whereAny(['name','price','count'],'like','%'.$searchKey.'%');
            })
            ->paginate(3);
    }

    public function getDetails($id)
    {
        return Product::with(['category'])
            ->findOrFail($id);
    }

    public function getEditData($id)
    {
        return Product::with(['category'])
            ->findOrFail($id);
    }
}
