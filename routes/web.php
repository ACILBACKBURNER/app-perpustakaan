<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route CRUD Kategori
Route::resource('categories', CategoryController::class);

// Route CRUD Buku
Route::resource('books', BookController::class);

// Route CRUD Anggota (Members)
Route::resource('members', MemberController::class);

// Route CRUD & Transaksi Peminjaman (Loans)
Route::resource('loans', LoanController::class);
Route::patch('/loans/{id}/return', [LoanController::class, 'updateStatus'])->name('loans.updateStatus');