<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProductController;

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
});

require __DIR__.'/auth.php';

// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/add-product', [ProductController::class, 'createProduct'])->middleware(IsAdmin::class);
Route::post('/add-product1', [ProductController::class, 'createProduct1'])->middleware(IsAdmin::class);
Route::get('/', [ProductController::class, 'viewProduct']);
Route::get('/edit-product/{id}', [ProductController::class, 'editProduct'])->middleware(IsAdmin::class);
Route::patch('/update-product/{id}', [ProductController::class, 'updateProduct'])->middleware(IsAdmin::class);
Route::delete('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->middleware(IsAdmin::class);

Route::get('/add-category', [CategoryController::class, 'addCategory'])->middleware(IsAdmin::class);
Route::post('/add-category1', [CategoryController::class, 'addCategory1'])->middleware(IsAdmin::class);

Route::get('/keranjang', [KeranjangController::class, 'viewKeranjang'])->middleware(IsUser::class);
Route::get('/keranjang1/{id}', [KeranjangController::class, 'editKeranjang'])->middleware(IsUser::class);

Route::get('/invoice',[InvoiceController::class, 'createInvoice'])->middleware(IsUser::class);
Route::post('/invoice1',[InvoiceController::class, 'createInvoice1'])->middleware(IsUser::class);
Route::patch('/update-jumlah/{id}', [InvoiceController::class, 'updateJumlah'])->middleware(IsUser::class);
Route::delete('/delete-keranjang/{id}', [InvoiceController::class, 'deleteKeranjang'])->middleware(IsUser::class);
Route::patch('/status-done', [InvoiceController::class, 'changeStatus'])->middleware(IsUser::class);

Route::get('/invoiceTotal/{id}', [InvoiceController::class, 'viewInvoice'])->middleware(IsUser::class);