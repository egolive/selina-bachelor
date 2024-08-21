<?php

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\RaffleController;
use App\Http\Middleware\BlockIpMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [SurveyController::class, 'trackRequest'])->middleware(BlockIpMiddleware::class);

Route::get('/gewinnspiel', [RaffleController::class, 'showForm']);
Route::post('/raffle/check', [RaffleController::class, 'checkCode'])->name('raffle.check');
Route::get('/voucher/download/{filename}', [RaffleController::class, 'downloadVoucher'])->name('voucher.download');
