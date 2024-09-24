<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Admin\BannerModel;
use App\Models\Admin\CategoriaModel;
use App\Models\Admin\FileModel;
use Illuminate\Http\Request;

class BannersController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(BannerModel $banner, CategoriaModel $categoria)
	{

		$data['categorias'] = $categoria->getAllCategorias();
		$data['banners']    = $banner->getAllBanners();

		return view('admin.paginas.home.banners.index', $data);

	}

	/**
	 * Search banners
	 */
	public function search(Request $request, BannerModel $banner)
	{

		$data['banners'] = $banner->search($request->search);

		return view('admin.paginas.home.banners.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request, BannerModel $banner, CategoriaModel $categoria)
	{

		$data['id']         = $request->id;
		$data['row']        = $banner->getBanner($request->id);
		$data['banners']    = $banner->getAllBanners();
		$data['categorias'] = $categoria->getAllCategorias();

		return view('admin.paginas.home.banners.index', $data);

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request, BannerModel $banner)
	{

		$count = $banner->getTotalBanners();

		if ($request->_method === 'put' || $count < config('site.banners_limit')) {

			$requestBanner = new BannerRequest();
			$request->validate($requestBanner->rules($request));

			$message = $banner->insert_or_update($request);

			if ($message) {
				if ($request->_method === 'put') {
					$message = 'Banner atualizado com sucesso!';
				} else {
					$message = 'Banner cadastrado com sucesso!';
				}
			} else {
				$message = 'Houve um erro ao inserir os dados.';
			}

		} else {

			$message = 'Não é possível adicionar mais banners. Exclua um ou mais banners para adicionar novos.';

		}

		return redirect()->route('admin.paginas.home.banners.index')->with(['message' => $message]);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id)
	{

		return $file->showFile($file_id, 'banner');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, BannerModel $banner)
	{

		if ($banner->remove($request->id, 'banner')) {
			$message = 'Banner removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('admin.paginas.home.banners.index')->with(['message' => $message]);

	}
}
