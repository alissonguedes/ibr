<?php

// Admin Controllers
use App\Http\Controllers\Admin\AgendaController as Agenda;
use App\Http\Controllers\Admin\Agenda\AniversariosController as AgendaAniversarios;
use App\Http\Controllers\Admin\Agenda\ComemoracoesController as AgendaComemoracoes;
use App\Http\Controllers\Admin\Agenda\CultosController as AgendaCultos;
use App\Http\Controllers\Admin\ApresentacaoController as Apresentacao;
use App\Http\Controllers\Admin\A_IbrController as A_Ibr;
use App\Http\Controllers\Admin\BannersController as Banners;
use App\Http\Controllers\Admin\CategoriasController as Categorias;
use App\Http\Controllers\Admin\CultosController as Cultos;
use App\Http\Controllers\Admin\EventosController as Eventos;
use App\Http\Controllers\Admin\MinisteriosController as Ministerios;
use App\Http\Controllers\Admin\PastoresController as Pastores;
use App\Http\Controllers\Admin\PostsController as Posts;
use App\Http\Controllers\Admin\PropositosController as Propositos;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Main\AgendaController;

// Main Controllers
use App\Http\Controllers\Main\CultosController;
use App\Http\Controllers\Main\EventosController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\InscricoesController;
use App\Http\Controllers\Main\MinisteriosController;
use App\Http\Controllers\Main\SobreController;
use App\Http\Controllers\ProfileController;

// Admin Requests

// Admin Models

// Illuminate
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {

	Route::get('/', [HomeController::class, 'index'])->name('site.home.index');
	Route::get('/a-ibr', [SobreController::class, 'index'])->name('site.home.a-ibr');
	Route::get('/ministerios', [MinisteriosController::class, 'index'])->name('site.ministerios');
	Route::get('/ministerios/{ministerio}', [MinisteriosController::class, 'show'])->name('site.ministerios.details');
	Route::get('/cultos', [CultosController::class, 'index'])->name('site.cultos');
	Route::get('/cultos/{culto}', [CultosController::class, 'show'])->name('site.cultos.details');
	Route::get('/eventos', [EventosController::class, 'index'])->name('site.eventos');
	Route::get('/eventos/{evento}', [EventosController::class, 'show'])->name('site.eventos.details');
	Route::get('/eventos/inscricao/{evento}', [InscricoesController::class, 'index'])->name('site.eventos.inscricoes');
	Route::post('/eventos/inscricao/{evento}', [InscricoesController::class, 'store'])->name('site.eventos.post');
	Route::get('/agenda', [AgendaController::class, 'index'])->name('site.agenda');
	Route::get('/seja-membro', [HomeController::class, 'index'])->name('site.seja-membro');

	Route::prefix('/uf')->group(function () {

		Route::get('/', function () {})->name('estados');
		Route::get('/{id?}/cidades', function () {
			$data = DB::table('tb_cidade')->where('id_estado', request('id'))
				->get();
			return response()->json($data);
		})->name('estados.get.cidades');

	});

});

Route::get('/imagem/banner/{file_id}', [Banners::class, 'show'])->name('home.banners.show-image');
Route::get('/imagem/post/{file_id}', [Posts::class, 'show'])->name('home.posts.show-image');
Route::get('/imagem/pastor/{file_id}', [Pastores::class, 'show'])->name('home.pastores.show-image');
Route::get('/imagem/usuarios/{file_id}', [RegisteredUserController::class, 'show'])->name('home.usuarios.show-image');
Route::get('/imagem/ministerio/{file_id}', [Ministerios::class, 'show'])->name('home.ministerios.show-image');
Route::get('/imagem/a-ibr/{file_id}', [A_Ibr::class, 'show'])->name('home.a-ibr.show-image');
Route::get('/imagem/apresentacao/{file_id}', [Apresentacao::class, 'show'])->name('home.apresentacao.show-image');
Route::get('/imagem/propositos/{file_id}', [Propositos::class, 'show'])->name('home.propositos.show-image');
Route::get('/imagem/cultos/{file_id}', [Cultos::class, 'show'])->name('home.cultos.show-image');
Route::get('/imagem/evento/{file_id}', [Eventos::class, 'show'])->name('home.eventos.show-image');
Route::get('/imagem/agenda/{file_id}', [Eventos::class, 'show'])->name('home.agenda.show-image');

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

	/** Categorias */
	Route::prefix('/categorias')->group(function () {

		Route::get('/', [Categorias::class, 'index'])->name('admin.categorias.index')->can('viewAny', App\Models\Admin\CategoriaModel::class);
		Route::get('/{search}', [Categorias::class, 'search'])->name('admin.categorias.search')->can('viewAny', App\Models\Admin\CategoriaModel::class);
		Route::post('/', [Categorias::class, 'store'])->name('admin.categorias.post')->can('create', App\Models\Admin\CategoriaModel::class);
		Route::get('/id/{id}', [Categorias::class, 'create'])->name('admin.categorias.edit')->can('update', App\Models\Admin\CategoriaModel::class);
		Route::put('/', [Categorias::class, 'store'])->name('admin.categorias.post')->can('update', App\Models\Admin\CategoriaModel::class);
		Route::delete('/', [Categorias::class, 'destroy'])->name('admin.categorias.delete')->can('delete', App\Models\Admin\CategoriaModel::class);

	});

	/** Usuários */
	Route::prefix('/usuarios')->group(function () {

		Route::get('/', [RegisteredUserController::class, 'index'])->name('admin.usuarios.index')->can('viewAny', App\Models\User::class);
		Route::get('/{search}', [RegisteredUserController::class, 'search'])->name('admin.usuarios.search')->can('viewAny', App\Models\User::class);
		Route::post('/', [RegisteredUserController::class, 'store'])->can('create', App\Models\User::class);
		Route::post('/', [RegisteredUserController::class, 'store'])->name('admin.usuarios.post')->can('update', App\Models\User::class);
		Route::get('/id/{id}', [RegisteredUserController::class, 'index'])->name('admin.usuarios.edit')->can('update', App\Models\User::class);
		Route::put('/', [RegisteredUserController::class, 'store'])->name('admin.usuarios.post')->can('update', App\Models\User::class);
		Route::delete('/', [RegisteredUserController::class, 'destroy'])->name('admin.usuarios.delete')->can('delete', App\Models\User::class);

	});

	Route::middleware('auth')->group(function () {
		Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
		Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
		Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->can('delete', App\Models\User::class);
	});

	/** banners */
	Route::prefix('/banners')->group(function () {

		Route::get('/', [Banners::class, 'index'])->name('admin.paginas.home.banners.index')->can('viewAny', App\Models\Admin\BannerModel::class);
		Route::get('/{search}', [Banners::class, 'search'])->name('admin.paginas.home.banners.search')->can('viewAny', App\Models\Admin\BannerModel::class);
		Route::post('/', [Banners::class, 'store'])->name('admin.paginas.home.banners.post')->can('create', App\Models\Admin\BannerModel::class);
		Route::get('/id/{id}', [Banners::class, 'create'])->name('admin.paginas.home.banners.edit')->can('update', App\Models\Admin\BannerModel::class);
		Route::put('/', [Banners::class, 'store'])->name('admin.paginas.home.banners.post')->can('update', App\Models\Admin\BannerModel::class);
		Route::delete('/', [Banners::class, 'destroy'])->name('admin.paginas.home.banners.delete')->can('delete', App\Models\Admin\BannerModel::class);

	});

	/** Apresentação */
	Route::prefix('/apresentacao')->group(function () {

		Route::get('/', [Apresentacao::class, 'index'])->name('admin.paginas.home.apresentacao.index')->can('viewAny', App\Models\Admin\ApresentacaoModel::class);
		Route::post('/', [Apresentacao::class, 'store'])->name('admin.paginas.home.apresentacao.post')->can('update', App\Models\Admin\ApresentacaoModel::class);
		Route::put('/', [Apresentacao::class, 'store'])->name('admin.paginas.home.apresentacao.post')->can('update', App\Models\Admin\ApresentacaoModel::class);
		Route::delete('/', [Apresentacao::class, 'destroy'])->name('admin.paginas.home.apresentacao.delete')->can('delete', App\Models\Admin\ApresentacaoModel::class);

	});

	/** A_Ibr */
	Route::prefix('/a-ibr')->group(function () {

		$request = new Request();
		Route::get('/', [A_Ibr::class, 'index'])->name('admin.paginas.a-ibr.index')->can('viewAny', App\Models\Admin\PostModel::class);
		Route::get('/{search}', [A_Ibr::class, 'search'])->name('admin.paginas.a-ibr.search')->can('viewAny', App\Models\Admin\PostModel::class);
		Route::post('/', [A_Ibr::class, 'store'])->name('admin.paginas.a-ibr.post')->can('create', App\Models\Admin\PostModel::class);
		Route::get('/id/{id}', [A_Ibr::class, 'create'])->name('admin.paginas.a-ibr.edit')->can('update', App\Models\Admin\PostModel::class);
		Route::put('/', [A_Ibr::class, 'store'])->name('admin.paginas.a-ibr.post')->can('update', App\Models\Admin\PostModel::class);
		Route::delete('/', [A_Ibr::class, 'destroy'])->name('admin.paginas.a-ibr.delete')->can('delete', App\Models\Admin\PostModel::class);

	});

	/** Ministérios */
	Route::prefix('/ministerios')->group(function () {

		Route::get('/', [Ministerios::class, 'index'])->name('admin.paginas.ministerios.index')->can('viewAny', App\Models\Admin\MinisterioModel::class);
		Route::get('/{search}', [Ministerios::class, 'search'])->name('admin.paginas.ministerios.search')->can('viewAny', App\Models\Admin\MinisterioModel::class);
		Route::post('/', [Ministerios::class, 'store'])->name('admin.paginas.ministerios.post')->can('create', App\Models\Admin\MinisterioModel::class);
		Route::get('/id/{id}', [Ministerios::class, 'create'])->name('admin.paginas.ministerios.edit')->can('update', App\Models\Admin\MinisterioModel::class);
		Route::put('/', [Ministerios::class, 'store'])->name('admin.paginas.ministerios.post')->can('update', App\Models\Admin\MinisterioModel::class);
		Route::delete('/', [Ministerios::class, 'destroy'])->name('admin.paginas.ministerios.delete')->can('delete', App\Models\Admin\MinisterioModel::class);

	});

	/** Pastores */
	Route::prefix('/corpo-pastoral')->group(function () {

		Route::get('/', [Pastores::class, 'index'])->name('admin.paginas.home.pastores.index')->can('viewAny', App\Models\Admin\PastorModel::class);
		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.paginas.home.pastores.search')->can('viewAny', App\Models\Admin\PastorModel::class);
		Route::post('/', [Pastores::class, 'store'])->name('admin.paginas.home.pastores.post')->can('create', App\Models\Admin\PastorModel::class);
		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.paginas.home.pastores.edit')->can('update', App\Models\Admin\PastorModel::class);
		Route::put('/', [Pastores::class, 'store'])->name('admin.paginas.home.pastores.post')->can('update', App\Models\Admin\PastorModel::class);
		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.paginas.home.pastores.delete')->can('delete', App\Models\Admin\PastorModel::class);

	});

	/** Cultos */
	Route::prefix('/cultos')->group(function () {

		Route::get('/', [Cultos::class, 'index'])->name('admin.paginas.cultos.index')->can('viewAny', App\Models\Admin\CultoModel::class);
		Route::get('/{search}', [Cultos::class, 'search'])->name('admin.paginas.cultos.search')->can('viewAny', App\Models\Admin\CultoModel::class);
		Route::post('/', [Cultos::class, 'store'])->name('admin.paginas.cultos.post')->can('create', App\Models\Admin\CultoModel::class);
		Route::get('/id/{id}', [Cultos::class, 'create'])->name('admin.paginas.cultos.edit')->can('update', App\Models\Admin\CultoModel::class);
		Route::put('/', [Cultos::class, 'store'])->name('admin.paginas.cultos.post')->can('update', App\Models\Admin\CultoModel::class);
		Route::delete('/', [Cultos::class, 'destroy'])->name('admin.paginas.cultos.delete')->can('delete', App\Models\Admin\CultoModel::class);

	});

	/** Eventos */
	Route::prefix('/eventos')->group(function () {

		Route::get('/', [Eventos::class, 'index'])->name('admin.paginas.eventos.index')->can('viewAny', App\Models\Admin\EventoModel::class);
		Route::get('/{search}', [Eventos::class, 'search'])->name('admin.paginas.eventos.search')->can('viewAny', App\Models\Admin\EventoModel::class);
		Route::post('/', [Eventos::class, 'store'])->name('admin.paginas.eventos.post')->can('create', App\Models\Admin\EventoModel::class);
		Route::get('/id/{id}', [Eventos::class, 'create'])->name('admin.paginas.eventos.edit')->can('update', App\Models\Admin\EventoModel::class);
		Route::put('/', [Eventos::class, 'store'])->name('admin.paginas.eventos.post')->can('update', App\Models\Admin\EventoModel::class);
		Route::delete('/', [Eventos::class, 'destroy'])->name('admin.paginas.eventos.delete')->can('delete', App\Models\Admin\EventoModel::class);

		Route::get('/id/{id}/inscritos', [Eventos::class, 'inscritos'])->name('admin.paginas.eventos.inscritos')->can('viewInscritos', App\Models\Admin\EventoModel::class);

	});

	/** Agenda */
	Route::prefix('/agenda')->group(function () {

		Route::get('/', [Agenda::class, 'index'])->name('admin.paginas.agenda.index')->can('viewAny', App\Models\Admin\AgendaModel::class);

		Route::get('/id/{id}', [Agenda::class, 'index'])->name('admin.paginas.agenda.edit')->can('viewAny', App\Models\Admin\AgendaModel::class);
		// // Route::get('/{search}', [Agenda::class, 'search'])->name('admin.paginas.agenda.search')->can('viewAny', App\Models\Admin\AgendaModel::class);

		// Route::get('/{year?}/{month?}/{day?}', [Agenda::class, 'show'])->name('admin.paginas.agenda.date')->can('view', App\Models\Admin\AgendaModel::class);
		// Route::get('/{year}/{month}/{day}/id/{id}', [Agenda::class, 'create'])->name('admin.paginas.agenda.date.edit')->can('viewAny', App\Models\Admin\AgendaModel::class);

		Route::post('/', [Agenda::class, 'store'])->name('admin.paginas.agenda.post')->can('create', App\Models\Admin\AgendaModel::class);
		Route::put('/', [Agenda::class, 'store'])->name('admin.paginas.agenda.post')->can('update', App\Models\Admin\AgendaModel::class);
		Route::delete('/', [Agenda::class, 'destroy'])->name('admin.paginas.agenda.delete')->can('delete', App\Models\Admin\AgendaModel::class);

		Route::prefix('/cultos')->group(function () {

			Route::get('/', [AgendaCultos::class, 'index'])->name('admin.paginas.agenda.cultos.index')->can('viewAny', App\Models\Admin\AgendaModel::class);
			Route::get('/{search}', [AgendaCultos::class, 'search'])->name('admin.paginas.agenda.cultos.search')->can('viewAny', App\Models\Admin\AgendaModel::class);
			Route::post('/', [AgendaCultos::class, 'store'])->name('admin.paginas.agenda.cultos.post')->can('create', App\Models\Admin\AgendaModel::class);
			Route::get('/id/{id}', [AgendaCultos::class, 'index'])->name('admin.paginas.agenda.cultos.edit')->can('update', App\Models\Admin\AgendaModel::class);
			Route::put('/', [AgendaCultos::class, 'store'])->name('admin.paginas.agenda.cultos.post')->can('update', App\Models\Admin\AgendaModel::class);
			Route::delete('/', [AgendaCultos::class, 'destroy'])->name('admin.paginas.agenda.cultos.delete')->can('delete', App\Models\Admin\AgendaModel::class);

		});

		Route::prefix('/comemoracoes')->group(function () {

			Route::get('/', [AgendaComemoracoes::class, 'index'])->name('admin.paginas.agenda.comemoracoes.index')->can('viewAny', App\Models\Admin\AgendaModel::class);
			Route::get('/{search}', [AgendaComemoracoes::class, 'search'])->name('admin.paginas.agenda.comemoracoes.search')->can('viewAny', App\Models\Admin\AgendaModel::class);
			Route::post('/', [AgendaComemoracoes::class, 'store'])->name('admin.paginas.agenda.comemoracoes.post')->can('create', App\Models\Admin\AgendaModel::class);
			Route::get('/id/{id}', [AgendaComemoracoes::class, 'index'])->name('admin.paginas.agenda.comemoracoes.edit')->can('update', App\Models\Admin\AgendaModel::class);
			Route::put('/', [AgendaComemoracoes::class, 'store'])->name('admin.paginas.agenda.comemoracoes.post')->can('update', App\Models\Admin\AgendaModel::class);
			Route::delete('/', [AgendaComemoracoes::class, 'destroy'])->name('admin.paginas.agenda.comemoracoes.delete')->can('delete', App\Models\Admin\AgendaModel::class);

		});

		Route::prefix('/aniversarios')->group(function () {

			Route::get('/', [AgendaAniversarios::class, 'index'])->name('admin.paginas.agenda.aniversarios.index')->can('viewAny', App\Models\Admin\AgendaModel::class);
			Route::get('/{search}', [AgendaAniversarios::class, 'search'])->name('admin.paginas.agenda.aniversarios.search')->can('viewAny', App\Models\Admin\AgendaModel::class);
			Route::post('/', [AgendaAniversarios::class, 'store'])->name('admin.paginas.agenda.aniversarios.post')->can('create', App\Models\Admin\AgendaModel::class);
			Route::get('/id/{id}', [AgendaAniversarios::class, 'index'])->name('admin.paginas.agenda.aniversarios.edit')->can('update', App\Models\Admin\AgendaModel::class);
			Route::put('/', [AgendaAniversarios::class, 'store'])->name('admin.paginas.agenda.aniversarios.post')->can('update', App\Models\Admin\AgendaModel::class);
			Route::delete('/', [AgendaAniversarios::class, 'destroy'])->name('admin.paginas.agenda.aniversarios.delete')->can('delete', App\Models\Admin\AgendaModel::class);

		});

	});

	/** Propósitos */
	Route::prefix('/propositos')->group(function () {

		Route::get('/', [Propositos::class, 'index'])->name('admin.paginas.home.propositos.index');
		Route::post('/', [Propositos::class, 'store'])->name('admin.paginas.home.propositos.post')->can('create', App\Models\Admin\PostModel::class);
		Route::put('/', [Propositos::class, 'store'])->name('admin.paginas.home.propositos.post')->can('create', App\Models\Admin\PostModel::class);
		Route::delete('/', [Propositos::class, 'destroy'])->name('admin.paginas.home.propositos.delete')->can('delete', App\Models\Admin\PostModel::class);

	});

	/** Configurações */
	Route::prefix('/configs')->group(function () {

		Route::get('/', function () {

			return view('admin.configuracoes.index');

		})->name('admin.configuracoes.index');

		Route::post('/', function () {

			$config = request()->all();

			unset($config['_token']);

			foreach ($config as $conf => $value) {

				$data = ['config' => $conf, 'value' => $value];

				App\Models\ConfigModel::updateOrCreate(['config' => $conf], $data);

			}

			return redirect()->route('admin.configuracoes.index')->with(['message' => 'Configurações salvas com sucesso!']);

		})->name('admin.configuracoes.index');

	});

	// Route::middleware('auth')->group(function () {
	// 	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	// 	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	// 	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	// });

});

require __DIR__ . '/auth.php';
