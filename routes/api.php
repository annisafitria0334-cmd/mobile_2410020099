<?php

use App\Http\Controllers\Api\JenisAktaController;
use App\Http\Controllers\Api\PemohonController;
use Illuminate\Support\Facades\Route;

Route::apiResource('jenis_akta', JenisAktaController::class);
Route::apiResource('pemohon', PemohonController::class);
