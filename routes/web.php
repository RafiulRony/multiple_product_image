<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[CategoryController::class, 'all_categories'])->name('all.category');
Route::get('/add-new-category',[CategoryController::class, 'add_new_category'])->name('add.category');
Route::post('/store-category' ,[CategoryController::class, 'store_category'])->name('store.category');
Route::get('/delete-category/{id}' ,[CategoryController::class, 'delete_category'])->name('delete.category');
Route::get('/edit-category/{id}' ,[CategoryController::class, 'edit_category'])->name('edit.category');
Route::post('/update-category/{id}' ,[CategoryController::class, 'update_category'])->name('update.category');

Route::get('/check',[CategoryController::class, 'check']);


Route::get('/category-product/{id}', [ProductController::class, 'category_product'])->name('category.product');
Route::get('/add-product',[ProductController::class, 'add_product'])->name('add.product');
Route::post('/store-product',[ProductController::class, 'store_product'])->name('store.product');
Route::get('/image-product/{id}',[ProductController::class, 'image_product'])->name('image.product');
Route::get('/all-product',[ProductController::class, 'all_product'])->name('all.product');
Route::get('/delete-product/{id}',[ProductController::class, 'delete_product'])->name('delete.product');
Route::get('/edit-product/{id}',[ProductController::class, 'edit_product'])->name('edit.product');
Route::post('/update-product/{id}',[ProductController::class, 'update_product'])->name('update.product');
