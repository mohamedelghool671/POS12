<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    // عرض كل المنتجات
    public function index()
    {
        $products = $this->productService->getProductList(request('searchKey'));
        return view('admin.product.list',compact('products'));
    }

    // صفحة إنشاء منتج جديد
    public function create()
    {
        $categories = $this->productService->getCategories();
        return view('admin.product.create',compact('categories'));
    }

    // حفظ منتج جديد
    public function store(StoreProductRequest $request)
    {
        $this->productService->createProductFromRequest($request);
        Alert::success(__('messages.insert_success'), __('messages.product_inserted_successfully'));
        return redirect()->route('product.index');
    }

    // عرض تفاصيل منتج
    public function show(Product $product)
    {
        $data = $this->productService->getProductDetails($product);
        return view('admin.product.details',compact('data'));
    }

    // صفحة تعديل منتج
    public function edit(Product $product)
    {
        $products = $this->productService->getProductEditData($product);
        $categories = $this->productService->getCategories();
        return view('admin.product.edit',compact('products','categories'));
    }

    // تحديث منتج
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productService->updateProductFromRequest($request, $product);
        Alert::success(__('messages.update_success'), __('messages.product_updated_successfully'));
        return redirect()->route('product.index');
    }

    // حذف منتج
    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);
        Alert::success(__('messages.delete_success'), __('messages.product_deleted_successfully'));
        return back();
    }



}
