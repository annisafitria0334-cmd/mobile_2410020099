<?php

use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\ProdukController;
use Illuminate\Support\Facades\Route;

Route::apiResource('pelanggan', PelangganController::class);
Route::apiResource('produk', ProdukController::class);
