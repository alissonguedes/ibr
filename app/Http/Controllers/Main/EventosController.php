<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\InscricoesRequest;
use App\Models\Admin\EventoModel;
use Illuminate\Http\Request;

class EventosController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(EventoModel $post) {

		$data['posts'] = $post->getAllActivePosts('evento');

		return view('main.eventos.index', $data);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, EventoModel $postModel, string $evento) {

		$data['id']   = $request->id;
		$data['post'] = $postModel->getEventoByTitulo($evento);

		if (!isset($data['post'])) {
			return redirect()->route('site.eventos');
		}

		return view('main.eventos.details', $data);

	}

	public function create(Request $request, EventoModel $postModel, string $evento) {

	}

	public function store(InscricoesRequest $request, EventoModel $eventoModel) {

		echo '==> ';

	}

}
