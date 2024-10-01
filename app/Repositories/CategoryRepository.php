<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends Repository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getAllCategories()
    {
        return $this->model->paginate(10);
    }

    public function getCategoryById(string $id)
    {
        return $this->model->select($this->table.'.*')
            ->findOrFail($id);
    }

    public function createCategory(array $data)
    {
        return $this->model->create($data);
    }

    public function updateCategoryById(string $id, array $data)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function deleteCategoryById(string $id)
    {
        return $this->model->delete($id);
    }
}
