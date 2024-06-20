<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Admin\EventoModel;
use App\Models\Admin\PostModel;
use Illuminate\Http\Request;

class EventosController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(PostModel $post)
	{

		$data['posts'] = $post->getAllPosts('evento');

		return view('main.eventos.index', $data);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, EventoModel $postModel, string $evento)
	{

		$data['id']      = $request->id;
		$data['post']    = $postModel->getEvento($evento);
		$data['eventos'] = $postModel->where('categoria', 'evento')
			->where('titulo_slug', '<>', $evento)
			->get();

		if (!isset($data['post'])) {
			return redirect()->route('site.eventos');
		}

		return view('main.eventos.details', $data);

	}
}
