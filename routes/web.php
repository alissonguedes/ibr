<?php

use App\Http\Controllers\Main\AgendaController;
use App\Http\Controllers\Main\CultosController;
use App\Http\Controllers\Main\EventosController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\MinisteriosController;
use App\Http\Controllers\Main\SobreController;
use App\Http\Controllers\ProfileController;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Admin\BannerModel;
use Illuminate\Support\Facades\Route;

function _getKeyAndHash($data = false, $file = false)
{

	if ($file) {
		$sha1 = base64_encode(sha1_file($data, true));
		$md5  = base64_encode(md5_file($data, true));
	} else {
		$sha1 = base64_encode(sha1($data, true));
		$md5  = base64_encode(md5($data, true));
	}

	$prefix = base64_encode(sha1(microtime(), true));
	$key    = str_replace(
		array('=', '+', '/'),
		array('', '-', '_'),
		substr($prefix, 0, 5) . $sha1
	);

	$hash = str_replace(
		array('=', '+', '/'),
		array('', '-', ' '),
		substr($sha1, 0, 16) . substr($md5, 0, 16)
	);

	return array($key, $hash);

}

function addAttachments($files, $inline = false, $lang = false)
{

	if (!empty($files)) {

		$type = 'H';
		if (is_array($files)) {

			foreach ($files as $file) {

				$file_name = $file->getClientOriginalName();
				$file_type = $file->getClientMimeType();
				$file_ext  = $file->getClientOriginalExtension();
				$file_size = $file->getSize();
				$file_tmp  = $file->getPathName();

				list($key, $sig) = _getKeyAndHash($file_tmp, true);

				// dump($key, $sig);

				// $columns = [
				// 	'ft'        => 'T',
				// 	'bk'        => 'D',
				// 	'type'      => $file_type,
				// 	'size'      => $file_size,
				// 	'name'      => $file_name,
				// 	'key'       => $key,
				// 	'signature' => $sig,
				// 	'attrs'     => null,
				// 	'created'   => date('Y-m-d H:i:s'),
				// ];

				// $file_id = $this->from('tb_file')->insertGetId($columns);

				// $this->write_file_chunk($file_id, $file);

				// $exists_attach = $this->where(array(
				// 	'object_id' => $object_id,
				// 	'type'      => $type,
				// 	'file_id'   => $file_id,
				// ))->exists();

				// if (!$exists_attach) {

				// 	$columns = [
				// 		'object_id' => $object_id,
				// 		'type'      => $type,
				// 		'file_id'   => $file_id,
				// 		'name'      => null,
				// 		'inline'    => 0,
				// 		'lang'      => null,
				// 	];

				// 	self::insert($columns);

				// }

			}
		} else {

			$file_name = $files->getClientOriginalName();
			$file_type = $files->getClientMimeType();
			$file_ext  = $files->getClientOriginalExtension();
			$file_size = $files->getSize();
			$file_tmp  = $files->getPathName();

			list($key, $sig) = _getKeyAndHash($file_tmp, true);

			return [
				'name' => $file_name,
				'type' => $file_type,
				'ext'  => $file_ext,
				'size' => $file_size,
				'tmp'  => $file_tmp,
			];

		}

	}

}

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

		Route::get('/id/{id}', function () {
			$data['id'] = request('id');
			return view('admin.home.banners.index', $data);
		})->name('admin.home.banners.edit');

		Route::post('/', function (BannerRequest $request) {

			$imagem = $request->file('imagem');

			addAttachments($imagem);

			$get = BannerModel::all();

		})->name('admin.home.banners.post');

		Route::put('/', function () {

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
