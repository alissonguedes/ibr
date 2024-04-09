<?php

use App\Http\Controllers\Main\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('main.index');

});
