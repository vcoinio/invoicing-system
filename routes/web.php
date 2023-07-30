<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FruitsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    //Category
    Route::get('categories', [CategoriesController::class, 'index'])->name('categories');

    Route::get('categories/create', [CategoriesController::class, 'create'])->name('create');

    Route::post('categories/create', [CategoriesController::class, 'store']);

    //Fruit
    Route::get('fruits', [FruitsController::class, 'index']);

    Route::get('fruits/create', [FruitsController::class, 'create']);
    Route::post('fruits/create', [FruitsController::class, 'store']);

    //Invoice
    Route::get('invoices', [InvoicesController::class, 'index'])->name('invoces');

    Route::get('postCategory', [PostCategoryController::class, 'PostIndex'])->name('postCategory');
});

require __DIR__ . '/auth.php';



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
