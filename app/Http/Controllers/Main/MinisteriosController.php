<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Admin\MinisterioModel;
use App\Models\Admin\PostModel;
use Illuminate\Http\Request;

class MinisteriosController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(PostModel $post)
	{

		$data['posts'] = $post->getAllPosts('ministerio');

		return view('main.ministerios.index', $data);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, MinisterioModel $ministerioModel, string $ministerio)
	{

		$data['id']          = $request->id;
		$data['post']        = $ministerioModel->getMinisterio($ministerio);
		$data['ministerios'] = $ministerioModel->where('categoria', 'ministerio')
			->where('titulo_slug', '<>', $ministerio)
			->get();

		if (!isset($data['post'])) {
			return redirect()->route('site.ministerios');
		}

		return view('main.ministerios.details', $data);

	}

}
