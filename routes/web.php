<?php

use App\Http\Controllers\LoanController;

Route::middleware('auth')->group(function () {

    Route::get('/items', [LoanController::class, 'index'])->name('items.index');

    Route::post('/borrow/{id}', [LoanController::class, 'borrow'])->name('borrow');

    Route::get('/my-loans', [LoanController::class, 'myLoans'])->name('loans.index');

    Route::post('/return/{loanId}', [LoanController::class, 'returnItem'])->name('return');
});
