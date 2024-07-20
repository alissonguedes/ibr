<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Admin\CultoModel;
use App\Models\Admin\PostModel;
use Illuminate\Http\Request;

class CultosController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(PostModel $post)
	{

		$data['posts'] = $post->getAllActivePosts('culto');

		return view('main.cultos.index', $data);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, CultoModel $postModel, string $culto)
	{

		$data['id']     = $request->id;
		$data['post']   = $postModel->getCulto($culto);
		$data['cultos'] = $postModel->where('categoria', 'culto')
			->where('titulo_slug', '<>', $culto)
			->get();

		if (!isset($data['post'])) {
			return redirect()->route('site.cultos');
		}

		return view('main.cultos.details', $data);

	}
}
