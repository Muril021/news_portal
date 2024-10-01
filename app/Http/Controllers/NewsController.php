<?php

namespace App\Http\Controllers;

use App\Factories\NotifyFactory as Notify;
use App\Http\Requests\NewsRequest;
use App\Services\CategoryService;
use App\Services\NewsService;
use App\Traits\UploadImageTrait;
use Exception;

class NewsController extends Controller
{
    use UploadImageTrait;

    private NewsService $newsService;
    private CategoryService $categoryService;

    public function __construct(
        NewsService $newsService,
        CategoryService $categoryService
    )
    {
        $this->newsService = $newsService;
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $search = request('search');

            if ($search) {
                $news = $this->newsService->getNewsListByTitleOrCategory($search);
            } else {
                $news = $this->newsService->getPaginatedNews();
            }

            return view('welcome', compact('news'));
        } catch (\Throwable $th) {
            return view('errors.main');
        }
    }

    public function show(string $slug)
    {
        try {
            $news = $this->newsService->getNewsBySlug($slug);

            return view('news.show', compact('news'));
        } catch (\Throwable $th) {
            Notify::makeError('Erro ao exibir notícia, tente novamente mais tarde.');
        }
    }

    public function getPaginatedNews()
    {
        try {
            $news = $this->newsService->getPaginatedNews();

            return view('news.index', compact('news'));
        } catch (\Throwable $th) {
            return view('errors.main');
        }
    }

    public function getNewsListByUser()
    {
        try {
            $news = $this->newsService->getNewsListByUserId();

            return view('news.my-news', compact('news'));
        } catch (\Throwable $th) {
            return view('errors.main');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = $this->categoryService->getAllCategories();

            return view('news.create', compact('categories'));
        } catch (\Throwable $th) {
            return view('errors.main');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        try {
            $data = $request->only(array_keys($request->rules()));

            $image = $this->uploadImage($request, 'banner', 'uploads');

            $this->newsService->createNews($data, $image);

            Notify::makeSuccess('Notícia criada com sucesso.');
            return redirect()->route('welcome');
        } catch (\Throwable $th) {
            Notify::makeError('Erro ao salvar notícia, tente novamente mais tarde.');
            return redirect()->route('welcome');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $news = $this->newsService->getNewsById($id);
            $categories = $this->categoryService->getAllCategories();

            return view('news.edit', compact('news', 'categories'));
        } catch (\Throwable $th) {
            return view('errors.main');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, string $id)
    {
        // dd($request->all());
        try {
            $data = $request->only(array_keys($request->rules()));
            $news = $this->newsService->getNewsById($id);
            $imagePath = $news->banner;

            $image = $this->updateImage($request, 'banner', 'uploads', $imagePath);

            $this->newsService->updateNewsById($data, $id, $image);

            Notify::makeSuccess('Notícia editada com sucesso.');
            return redirect()->route('welcome');
        } catch (\Throwable $th) {
            Notify::makeError('Erro ao editar notícia, tente novamente mais tarde.');
            return redirect()->route('welcome');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $news = $this->newsService->getNewsById($id);

            $this->deleteImage($news->banner);

            $this->newsService->deleteNewsById($id);

            Notify::makeSuccess('Notícia removida com sucesso.');
            return redirect()->route('welcome');
        } catch (\Throwable $th) {
            Notify::makeError('Erro ao remover a notícia, tente novamente mais tarde.');
            return redirect()->route('welcome');
        }
    }
}
