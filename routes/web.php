<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FruitsController;
use App\Http\Controllers\InvoicesController;
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
    return view('home');
});

Route::get('categories', [
    CategoriesController::class,
    'index'
]);

Route::get('fruits', [
    FruitsController::class,
    'index'
]);

Route::get('invoices', [
    InvoicesController::class,
    'index'
]);

Route::get('/redirect', function () {
    return redirect('/');
});
