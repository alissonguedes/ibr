<?php

// Admin Controllers
use App\Http\Controllers\Admin\ApresentacaoController as Apresentacao;
use App\Http\Controllers\Admin\BannersController as Banners;
use App\Http\Controllers\Admin\PastoresController as Pastores;

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

Route::get('/imagem/banner/{file_id}', [Banners::class, 'show'])->name('home.banners.show-image');
Route::get('/imagem/post/{file_id}', [Apresentacao::class, 'show'])->name('home.apresentacao.show-image');
Route::get('/imagem/pastor/{file_id}', [Pastores::class, 'show'])->name('home.pastores.show-image');

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
		// Route::get('/imagem/{file_id}', [Banners::class, 'show'])->name('admin.home.banners.show-image');
		Route::post('/', [Banners::class, 'store'])->name('admin.home.banners.post');
		Route::put('/', [Banners::class, 'store'])->name('admin.home.banners.post');
		Route::delete('/', [Banners::class, 'destroy'])->name('admin.home.banners.delete');

	});

	/** Apresentação */
	Route::prefix('/apresentacao')->group(function () {

		Route::get('/', [Apresentacao::class, 'index'])->name('admin.home.apresentacao.index');
		Route::get('/{search}', [Apresentacao::class, 'search'])->name('admin.home.apresentacao.search');
		Route::get('/id/{id}', [Apresentacao::class, 'create'])->name('admin.home.apresentacao.edit');
		// Route::get('/imagem/{file_id}', [Apresentacao::class, 'show'])->name('admin.home.apresentacao.show-image');
		Route::post('/', [Apresentacao::class, 'store'])->name('admin.home.apresentacao.post');
		Route::put('/', [Apresentacao::class, 'store'])->name('admin.home.apresentacao.post');
		Route::delete('/', [Apresentacao::class, 'destroy'])->name('admin.home.apresentacao.delete');

	});

	Route::prefix('/pastores')->group(function () {

		Route::get('/', [Pastores::class, 'index'])->name('admin.home.pastores.index');
		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.home.pastores.search');
		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.home.pastores.edit');
		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.home.pastores.show-image');
		Route::post('/', [Pastores::class, 'store'])->name('admin.home.pastores.post');
		Route::put('/', [Pastores::class, 'store'])->name('admin.home.pastores.post');
		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.home.pastores.delete');

	});

	Route::middleware('auth')->group(function () {
		Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
		Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
		Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	});

});

require __DIR__ . '/auth.php';
