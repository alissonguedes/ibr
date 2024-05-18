<?php

use App\Http\Controllers\Main\AgendaController;
use App\Http\Controllers\Main\CultosController;
use App\Http\Controllers\Main\EventosController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\MinisteriosController;
use App\Http\Controllers\Main\SobreController;
use App\Http\Controllers\ProfileController;
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

Route::middleware([
	'auth',
	'verified',
])->prefix('/admin')->middleware(['auth', 'verified'])->group(function () {

	Route::get('/', function () {
		return redirect()->route('admin.dashboard');
	})->name('dashboard');

	Route::get('/dashboard', function () {
		return view('admin.dashboard');
	})->name('admin.dashboard');

	/** banners */
	Route::prefix('/banners')->group(function () {

		Route::get('/', function () {
			return view('admin.home.banners.index');
		})->name('admin.home.banners.index');

		Route::post('/', function () {
			return view('admin.home.banners.index');
		})->name('admin.home.banners.post');

	});

	/** nossa-crenca */
	Route::get('/nossa-crenca', function () {
		return view('admin.home.nossa-crenca');
	})->name('admin.home.nossa-crenca');

	Route::get('/pastores', function () {
		return view('admin.home.nossa-crenca');
	})->name('admin.home.pastores');

	Route::middleware('auth')->group(function () {
		Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
		Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
		Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	});

});

require __DIR__ . '/auth.php';
