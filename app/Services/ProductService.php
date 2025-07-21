<?php

namespace App\Services;

use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function getProductById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function getProductList($searchKey = null)
    {
        return $this->productRepository->getList($searchKey);
    }

    public function getProductDetails(Product $product)
    {
        return $this->productRepository->getDetails($product->id);
    }

    public function getProductEditData(Product $product)
    {
        return $this->productRepository->getEditData($product->id);
    }

    public function getCategories()
    {
        return \App\Models\Category::get();
    }

    protected function prepareProductData($request)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'purchase_price' => $request->purchaseprice,
            'description' => $request->description,
            'category_id' => $request->categoryName,
            'count' => $request->count,
        ];
        if ($request->hasFile('image')) {
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path() . '/productImages/', $fileName);
            $data['image'] = $fileName;
        } elseif ($request->oldImage) {
            $data['image'] = $request->oldImage;
        }
        return $data;
    }

    public function createProductFromRequest($request)
    {
        $data = $this->prepareProductData($request);
        return $this->productRepository->create($data);
    }

    public function updateProductFromRequest($request, Product $product)
    {
        // حذف الصورة القديمة إذا تم رفع صورة جديدة
        if ($request->hasFile('image') && $request->oldImage && file_exists(public_path('productImages/' . $request->oldImage))) {
            unlink(public_path('productImages/' . $request->oldImage));
        }
        $data = $this->prepareProductData($request);
        return $this->productRepository->update($product, $data);
    }

    public function deleteProduct(Product $product)
    {
        return $this->productRepository->delete($product);
    }
}
