<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('books', BookController::class);

Route::resource('categories', CategoryController::class)
    ->except(['show']);

Route::resource('members', MemberController::class);

Route::resource('loans', LoanController::class);

Route::put('/loans/{id}/kembalikan', [LoanController::class, 'kembalikan'])
    ->name('loans.kembalikan');

Route::prefix('admin')->group(function () {
    Route::get('/info', function () {
        return 'Halaman informasi admin';
    })->name('admin.info');
});