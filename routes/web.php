<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produtos', [ProdutoController::class, 'list'])->name('produtos.list');
Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
Route::put('/produtos/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
Route::get('/produtos/{id}/edit', [ProdutoController::class, 'edit'])->name('produtos.edit');
Route::delete('/produtos/{id}/delete', [ProdutoController::class, 'delete'])->name('produtos.delete');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
