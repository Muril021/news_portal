<?php

namespace App\Http\Controllers;

use App\Factories\NotifyFactory as Notify;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = $this->categoryService->getAllCategories();

            return view('category.index', compact('categories'));
        } catch (\Throwable $th) {
            return view('errors.main', [
                'message' => 'Ops! Ocorreu um erro ao exibir a lista de categorias.'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       try {
        return view('category.create');
       } catch (\Throwable $th) {
        return view('errors.main', [
            'message' => 'Ops! Ocorreu um erro ao exibir a página.'
        ]);
       }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->only(array_keys($request->rules()));

            $this->categoryService->createCategory($data);

            Notify::makeSuccess('Categoria criada com sucesso.');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Notify::makeError('Erro ao salvar categoria, tente novamente mais tarde.');
            return redirect()->route('category.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = $this->categoryService->getCategoryById($id);

            return view('category.edit', compact('category'));
        } catch (\Throwable $th) {
            return view('errors.main', [
                'message' => 'Ops! Ocorreu um erro ao exibir a lista de categorias.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        try {
            $data = $request->only(array_keys($request->rules()));

            $this->categoryService->updateCategoryById($id, $data);

            Notify::makeSuccess('Categoria editada com sucesso.');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Notify::makeError('Erro ao editar categoria, tente novamente mais tarde.');
            return redirect()->route('category.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->categoryService->deleteCategoryById($id);

            Notify::makeSuccess('Categoria removida com sucesso.');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Notify::makeError('Erro ao remover categoria, tente novamente mais tarde.');
            return redirect()->route('category.index');
        }
    }
}
