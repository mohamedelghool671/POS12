<?php

namespace App\Services;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAll();
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->findById($id);
    }

    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function updateCategory(Category $category, array $data)
    {
        return $this->categoryRepository->update($category, $data);
    }

    public function deleteCategory(Category $category)
    {
        return $this->categoryRepository->delete($category);
    }
}
