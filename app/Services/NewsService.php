<?php

namespace App\Services;

use App\Repositories\NewsRepository;
use Illuminate\Support\Facades\Auth;

class NewsService extends Service
{
    public function __construct(NewsRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getPaginatedNews()
    {
        return $this->repository->getPaginatedNews();
    }

    public function getNewsListByUserId()
    {
        return $this->repository->getNewsListByUserId(Auth::user()->id);
    }

    public function getNewsById(string $id)
    {
        return $this->repository->getNewsById($id);
    }

    public function getNewsBySlug(string $slug)
    {
        return $this->repository->getNewsBySlug($slug);
    }

    public function getNewsListByTitleOrCategory(string $search)
    {
        return $this->repository->getNewsListByTitleOrCategory($search);
    }

    public function createNews(array $data, $image)
    {
        $data['user_id'] = Auth::user()->id;
        $data['banner'] = $image;

        return $this->repository->createNews($data);
    }

    public function updateNewsById(array $data, string $id, $image)
    {
        if ($image) {
            $data['banner'] = $image;
        }

        return $this->repository->updateNewsById($id, $data);
    }

    public function deleteNewsById(string $id)
    {
        return $this->repository->delete($id);
    }
}
