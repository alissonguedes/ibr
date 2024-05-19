<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Admin\BannerModel;
use Illuminate\Http\Request;

class BannersController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index() {

		$data['banners'] = BannerModel::all();

		return view('admin.home.banners.index', $data);

	}

	/**
	 * Search banners
	 */
	public function search(Request $request, BannerModel $banner) {

		$data['banners'] = BannerModel::where('titulo', 'like', $request->search . '%')->get();

		return view('admin.home.banners.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request, BannerModel $banner) {

		$data['id']      = $request->id;
		$data['row']     = $banner->getWhere('id', $request->id);
		$data['banners'] = BannerModel::all();

		return view('admin.home.banners.index', $data);

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(BannerRequest $request, BannerModel $banner) {

		$banner->insert_or_update($request);

		if ($request->_method === 'put') {
			$message = 'Banner atualizado com sucesso!';
		} else {
			$message = 'Banner cadastrado com sucesso!';
		}

		return redirect()->route('admin.home.banners.index')->with(['message' => $message]);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, BannerModel $attachment, int $file_id) {

		$info   = $attachment->getInfoFromFile($file_id);
		$chunks = $attachment->getFile($file_id);

		if ($chunks->count() > 0) {

			header('Content-type: ' . $info->imgtype);

			$filedata = null;

			foreach ($chunks as $chunk) {
				$filedata .= $chunk->filedata;
			}

			if (request('action') && request('action') === 'download') {

				header('Content-Description: File Preview/Download');
				header('Content-Disposition: attachment; filename=' . $info->imgname);
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . $info->imgsize);

				return $filedata;

			} else if (request('action') && request('action') === 'preview') {

				$type = explode('/', $info->imgtype)[0];

				if ($type === 'image') {

					return $filedata;

				} else {

					return response()->json([
						'data' => $filedata,
						'type' => $info->imgtype,
						'name' => $info->imgname,
						'size' => $info->imgsize,
					], 200);
				}

			}

		}

		return redirect(url()->previous())->with('file_not_exists', 'Não foi possível realizar download do arquivo. <small>404 - Arquivo não encontrado.</small>');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, BannerModel $banner) {

		return $banner->forge($request->id);

	}
}
