<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FruitsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomersController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Category
    Route::get('categories', [CategoriesController::class, 'index'])->name('categories.index');

    Route::get('categories/create', [CategoriesController::class, 'create'])->name('categories.create');

    Route::post('categories/create', [CategoriesController::class, 'store']);

    //Fruit
    Route::get('fruits', [FruitsController::class, 'index']);
    Route::get('fruits/create', [FruitsController::class, 'create']);
    Route::post('fruits/create', [FruitsController::class, 'store']);
    Route::get('fruits/getFruit/{fruitId}', [FruitsController::class, 'getFruit'])->name('fruits.getFruit');


    //Invoice
    Route::get('invoices', [InvoicesController::class, 'index'])->name('invoices.index');
    Route::get('invoices/create', [InvoicesController::class, 'create'])->name('invoices.create');
    Route::post('invoices/create', [InvoicesController::class, 'store'])->name('invoices.store');
    Route::get('invoices/select', [InvoicesController::class, 'select'])->name('invoices.select');
    Route::get('invoices/{invoice}', [InvoicesController::class, 'edit'])->name('invoices.edit');
    Route::delete('invoices/{invoice}', [InvoicesController::class, 'delete'])->name('invoices.delete');
    Route::delete('invoices/{invoice}/fruits/{fruit}', [InvoicesController::class, 'fruitDelete'])->name('invoices.fruits.remove');



    //customer
    Route::post('/customers', [CustomersController::class, 'store'])->name('customers.store');
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
