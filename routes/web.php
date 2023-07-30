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



Route::get('/', [
    HomeController::class, 'HomeIndex'
])->name('home');

Route::get('categories', [
    CategoriesController::class,
    'CategoryIndex'
])->name('categories');

Route::get('fruits', [
    FruitsController::class,
    'FruitIndex'
])->name('fruits');

Route::get('invoices', [
    InvoicesController::class,
    'InvoiceIndex'
])->name('invoces');

Route::get('postCategory', [
    PostCategoryController::class,
    'PostIndex'
])->name('postCategory');
