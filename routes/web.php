<?php

// Admin Controllers
use App\Http\Controllers\Admin\BannersController as Banners;
use App\Http\Controllers\Admin\SobrenosController as Sobrenos;

// Main Controllers
use App\Http\Controllers\Main\AgendaController;
use App\Http\Controllers\Main\CultosController;
use App\Http\Controllers\Main\EventosController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\MinisteriosController;
use App\Http\Controllers\Main\SobreController;
use App\Http\Controllers\ProfileController;

// Admin Requests

// Admin Models

// Illuminate
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

		Route::get('/', [Banners::class, 'index'])->name('admin.home.banners.index');
		Route::get('/{search}', [Banners::class, 'search'])->name('admin.home.banners.search');
		Route::get('/id/{id}', [Banners::class, 'create'])->name('admin.home.banners.edit');
		Route::get('/imagem/{file_id}', [Banners::class, 'show'])->name('admin.home.banners.show-image');
		Route::post('/', [Banners::class, 'store'])->name('admin.home.banners.post');
		Route::put('/', [Banners::class, 'store'])->name('admin.home.banners.post');
		Route::delete('/', [Banners::class, 'destroy'])->name('admin.home.banners.delete');

	});

	/** nossa-crenca */
	Route::prefix('/nossa-crenca')->group(function () {

		Route::get('/', [Sobrenos::class, 'index'])->name('admin.home.nossa-crenca.index');
		Route::get('/{search}', [Sobrenos::class, 'search'])->name('admin.home.nossa-crenca.search');
		Route::get('/id/{id}', [Sobrenos::class, 'create'])->name('admin.home.nossa-crenca.edit');
		Route::get('/imagem/{file_id}', [Sobrenos::class, 'show'])->name('admin.home.nossa-crenca.show-image');
		Route::post('/', [Sobrenos::class, 'store'])->name('admin.home.nossa-crenca.post');
		Route::put('/', [Sobrenos::class, 'store'])->name('admin.home.nossa-crenca.post');
		Route::delete('/', [Sobrenos::class, 'destroy'])->name('admin.home.nossa-crenca.delete');

	});

	Route::get('/pastores', function () {
		return view('admin.home.nossa-crenca.index');
	})->name('admin.home.pastores');

	Route::middleware('auth')->group(function () {
		Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
		Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
		Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	});

});

require __DIR__ . '/auth.php';
