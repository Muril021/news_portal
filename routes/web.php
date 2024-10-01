<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [
    NewsController::class,
    'index'
])->name('welcome');

Route::middleware('auth')
    ->prefix('/categorias')
    ->group(function () {
        Route::get(
            '',
            [CategoryController::class, 'index']
        )->name('category.index');

        Route::group(['middleware' => ['role:admin']], function () {
            Route::get(
                '/criar',
                [CategoryController::class, 'create']
            )->name('category.create');

            Route::post(
                '',
                [CategoryController::class, 'store']
            )->name('category.store');

            Route::get(
                '/{id}/editar',
                [CategoryController::class, 'edit']
            )->name('category.edit');

            Route::put(
                '/{id}',
                [CategoryController::class, 'update']
            )->name('category.update');

            Route::delete(
                '/{id}',
                [CategoryController::class, 'destroy']
            )->name('category.destroy');
        });
    });

Route::middleware('auth')
    ->prefix('/noticias')
    ->group(function () {
        Route::group(['middleware' => ['role:admin']], function () {
            Route::get(
                '/lista',
                [NewsController::class, 'getPaginatedNews']
            )->name('news.all');
        });

        Route::group(['middleware' => ['role:editor']], function () {
            Route::get(
                '/minhas-noticias',
                [NewsController::class, 'getNewsListByUser']
            )->name('news.my-news');
        });

        Route::get(
            '/criar',
            [NewsController::class, 'create']
        )->name('news.create');

        Route::post(
            '',
            [NewsController::class, 'store']
        )->name('news.store');

        Route::get(
            '/{id}/editar',
            [NewsController::class, 'edit']
        )->name('news.edit');

        Route::put(
            '/{id}',
            [NewsController::class, 'update']
        )->name('news.update');

        Route::delete(
            '/{id}',
            [NewsController::class, 'destroy']
        )->name('news.destroy');
    });

Route::get(
    '/noticias/{slug}',
    [NewsController::class, 'show']
)->name('news.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')
    ->prefix('/perfil')
    ->group(function () {
        Route::get(
            '',
            [ProfileController::class, 'edit']
        )->name('profile.edit');

        Route::patch(
            '',
            [ProfileController::class, 'update']
        )->name('profile.update');

        Route::delete(
            '',
            [ProfileController::class, 'destroy']
        )->name('profile.destroy');
    });

Route::fallback(function () {
    return response()->view('errors.main', [
        'message' => '404 | NOT FOUND',
    ], 404);
});

require __DIR__.'/auth.php';
