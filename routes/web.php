<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DegreeCafeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TableController;

Route::get('/table',[TableController::class,'index'])->name('table.index');
Route::post('/table/store',[TableController::class,'store'])->name('table.store');
Route::put('/table/update/{id}',[TableController::class,'update'])->name('table.update');
Route::get('/degreecafe',[DegreeCafeController::class,'index'])->name('degreecafe.index');
Route::post('/degreecafe/store',[DegreeCafeController::class,'store'])->name('degreecafe.store');


//create the route for category
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
Route::delete('/category/delete/{id}',[CategoryController::class,'deleteCategory'])->name('category.destroy');
Route::get('/category/edit/{id}',[CategoryController::class,'editCategory'])->name('category.edit');
Route::put('/category/update/{id}',[CategoryController::class,'updateCategory'])->name('category.update');

//Route for menu
Route::get('/menu/create',[MenuController::class,'create'])->name('menu.create');
Route::post('/menu/save',[MenuController::class,'store'])->name('menu.store');
Route::get('/menu',[MenuController::class,'index'])->name('menu.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
Route::get('/show-tables',[SaleController::class,'showTables'])->name('sale.show_tables');
Route::get('/',[SaleController::class,'pos'])->name('sale.pos');
Route::get('/pos/{table_no}/{id?}',[SaleController::class,'index'])->name('sale.index');
