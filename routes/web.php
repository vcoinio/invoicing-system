<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FruitsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Home
Route::get('/', [
    HomeController::class, 'index'
])->name('home');

//Category
Route::get('categories', [
    CategoriesController::class,
    'index'
])->name('categories');

Route::get('categories/create', [
    CategoriesController::class,
    'create'
])->name('create');

Route::post('categories/store', [
    PostCategoryController::class, 'store'
]);

//Fruit
Route::get(
    'fruits',
    [FruitsController::class, 'index']
);

Route::get('fruits/create', [FruitsController::class, 'create']);
Route::post('fruits/create', [FruitsController::class, 'store']);

//Invoice
Route::get('invoices', [
    InvoicesController::class,
    'index'
])->name('invoces');

Route::get('postCategory', [
    PostCategoryController::class,
    'PostIndex'
])->name('postCategory');
