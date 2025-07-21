<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService) {}

    // عرض كل التصنيفات
    public function index()
    {
        $data = $this->categoryService->getAllCategories();
        return view('admin.category.list', compact('data'));
    }

    // صفحة إنشاء تصنيف جديد
    public function create()
    {
        return view('admin.category.create');
    }

    // حفظ تصنيف جديد
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->createCategory(['name' => $request->category]);
        Alert::success(__('messages.insert_success'), __('messages.category_inserted_successfully'));
        return redirect()->route('category.index');
    }

    // صفحة تعديل تصنيف
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    // تحديث تصنيف
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService->updateCategory($category, ['name' => $request->category]);
        Alert::success(__('messages.update_success'), __('messages.category_updated_successfully'));
        return redirect()->route('category.index');
    }

    // حذف تصنيف
    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);
        Alert::success(__('messages.delete_success'), __('messages.category_deleted_successfully'));
        return back();
    }
}
