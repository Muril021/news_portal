<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository extends Repository
{
    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    public function getAllNews()
    {
        return $this->model->orderBy('created_at', 'desc')
            ->get();
    }

    public function getPaginatedNews()
    {
        return $this->model->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getNewsListByUserId(string $userId)
    {
        return $this->model->select($this->table.'.*')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getNewsById(string $id)
    {
        return $this->model->select($this->table.'.*')
            ->findOrFail($id);
    }

    public function getNewsBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)
            ->first();
    }

    public function getNewsListByTitleOrCategory(string $search)
    {
        return $this->model->select($this->table.'.*')
            ->join('categories', $this->table.'.category_id', '=', 'categories.id')
            ->whereRaw('LOWER(title) LIKE ?', ['%'.strtolower($search).'%'])
            ->orWhereRaw('LOWER(categories.name) LIKE ?', [strtolower($search)])
            ->get();
    }

    public function createNews(array $data)
    {
        return $this->model->create($data);
    }

    public function updateNewsById(string $id, array $data)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function deleteNewsById(string $id)
    {
        return $this->model->delete($id);
    }
}
