<?php

use App\Http\Controllers\admin\category\BrandController;
use App\Http\Controllers\admin\category\CategoryController;
use App\Http\Controllers\admin\category\SubCatController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('pages.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/admin', function () {
    return view('admin.index');
});



//category related route
Route::get('/admin/category',[CategoryController::class,'CategoryView'])->name('category.view');
Route::post('/admin/category/store',[CategoryController::class,'CategoryStore'])->name('store.category');
Route::get('/admin/category/delete/{id}',[CategoryController::class,'CategoryDelete'])->name('category.delete');
Route::get('/admin/category/edit/{id}',[CategoryController::class,'CategoryEdit'])->name('category.edit');
Route::post('/admin/category/update/{id}',[CategoryController::class,'CategoryUpdate'])->name('update.category');


//brands related route
Route::get('/admin/brand',[BrandController::class,'BrandView'])->name('brands.view');
Route::post('/admin/brand/store',[BrandController::class,'BrandStore'])->name('store.brand');
Route::get('/admin/brand/delete/{id}',[BrandController::class,'BrandDelete'])->name('brand.delete');
Route::get('/admin/brand/edit/{id}',[BrandController::class,'BrandEdit'])->name('brand.edit');
Route::post('/admin/brand/update/{id}',[BrandController::class,'BrandUpdate'])->name('update.brand');


//subcategory related route
Route::get('/admin/subcategory',[SubCatController::class,'SubCatView'])->name('subcategory_view.view');
Route::post('/admin/subcat/store',[SubCatController::class,'SubCatStore'])->name('store.subcategory');
Route::get('/admin/subcat/delete/{id}',[SubCatController::class,'SubCatDelete'])->name('subcategory.delete');
Route::get('/admin/subcat/edit/{id}',[SubCatController::class,'SubCatEdit'])->name('subcategory.edit');
Route::post('/admin/subcat/update/{id}',[SubCatController::class,'SubCatUpdate'])->name('update.subcategory');


