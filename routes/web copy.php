<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/keranjang', function () {
//     return view('keranjang');
// });

Route::get('/login', function () {
    return view('login');
});

Route::get('/add-product', [ProductController::class, 'createProduct']);
Route::post('/add-product1', [ProductController::class, 'createProduct1']);
Route::get('/', [ProductController::class, 'viewProduct']);
Route::get('/edit-product/{id}', [ProductController::class, 'editProduct']);
Route::patch('/update-product/{id}', [ProductController::class, 'updateProduct']);
Route::delete('/delete-product/{id}', [ProductController::class, 'deleteProduct']);

Route::get('/add-category', [CategoryController::class, 'addCategory']);
Route::post('/add-category1', [CategoryController::class, 'addCategory1']);

Route::get('/keranjang', [KeranjangController::class, 'viewKeranjang']);
Route::get('/keranjang1/{id}', [KeranjangController::class, 'editKeranjang']);

Route::get('/invoice',[InvoiceController::class, 'createInvoice']);
Route::post('/invoice1',[InvoiceController::class, 'createInvoice1']);
Route::patch('/update-jumlah/{id}', [InvoiceController::class, 'updateJumlah']);
Route::delete('/delete-keranjang/{id}', [InvoiceController::class, 'deleteKeranjang']);
Route::patch('/status-done', [InvoiceController::class, 'changeStatus']);

Route::get('/invoiceTotal/{id}', [InvoiceController::class, 'viewInvoice']);