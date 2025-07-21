<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::with('products')->orderBy('id')->paginate(3);
    }

    public function findById($id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data)
    {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category)
    {
        return $category->delete();
    }
}
