<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Auth;

class CategoryService extends Service
{
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getAllCategories()
    {
        return $this->repository->getAllCategories();
    }

    public function getCategoryById(string $id)
    {
        return $this->repository->getCategoryById($id);
    }

    public function createCategory(array $data)
    {
        $data['user_id'] = Auth::user()->id;

        return $this->repository->createCategory($data);
    }

    public function updateCategoryById(string $id, array $data)
    {
        return $this->repository->updateCategoryById($id, $data);
    }

    public function deleteCategoryById(string $id)
    {
        return $this->repository->delete($id);
    }
}
