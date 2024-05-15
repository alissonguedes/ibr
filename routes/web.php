<?php

use App\Http\Controllers\Main\AgendaController;
use App\Http\Controllers\Main\CultosController;
use App\Http\Controllers\Main\EventosController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\MinisteriosController;
use App\Http\Controllers\Main\SobreController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {

	Route::get('/', [HomeController::class, 'index'])->name('site.home.index');
	Route::get('/a-ibr', [SobreController::class, 'index'])->name('site.home.a-ibr');
	Route::get('/ministerios', [MinisteriosController::class, 'index'])->name('site.home.ministerios');
	Route::get('/cultos', [CultosController::class, 'index'])->name('site.home.cultos');
	Route::get('/eventos', [EventosController::class, 'index'])->name('site.home.eventos');
	Route::get('/agenda', [AgendaController::class, 'index'])->name('site.home.agenda');
	Route::get('/seja-membro', [HomeController::class, 'index'])->name('site.home.seja-membro');

});
