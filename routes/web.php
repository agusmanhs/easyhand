<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceiptController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/receipt/{ref_id}', [ReceiptController::class, 'show'])->name('receipt.show');
