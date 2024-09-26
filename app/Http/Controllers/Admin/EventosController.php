<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventoRequest;
use App\Models\Admin\EventoModel;
use App\Models\Admin\FileModel;
use App\Models\Admin\InscricaoModel;
use App\Models\Admin\PostModel;
use Illuminate\Http\Request;

class EventosController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, EventoModel $post, InscricaoModel $inscricao)
	{

		$data['posts'] = $post->getAllEventos();

		// Pesquisar agendamentos
		if ($request->ajaxCalendar) {
			return response(view('admin.paginas.eventos.json', $data), 200);
		} else {
			return view('admin.paginas.eventos.index', $data);
		}

	}

	/**
	 * Search banners
	 */
	public function search(Request $request, PostModel $post, InscricaoModel $inscricao)
	{

		$data['posts'] = $post->search($request->search, true, 'eventos');

		return view('admin.paginas.eventos.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request, EventoModel $post)
	{

		$data['id']    = $request->id;
		$data['row']   = $post->getEvento($request->id);
		$data['posts'] = $post->getAllEventos();

		if (!$data['row']) {
			return redirect()->route('admin.paginas.eventos.index');
		}

		return view('admin.paginas.eventos.index', $data);

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(EventoRequest $request, EventoModel $page)
	{

		$id = $page->insert_or_update($request);

		if ($request->_method === 'put') {
			$message = 'Evento atualizado com sucesso!';
		} else {
			$message = 'Evento cadastrado com sucesso!';
		}

		return redirect()->route('admin.paginas.eventos.edit', $id . '#formulario-inscricao')->with(['message' => $message]);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id)
	{

		return $file->showFile($file_id, 'evento');

	}

	/**
	 * Display the especified resource.
	 */
	public function inscritos(Request $request, EventoModel $post, InscricaoModel $inscricao)
	{

		$data['id']  = $request->id;
		$data['row'] = $post->getEvento($request->id);
		// $data['posts'] = $post->getAllEventos();

		// if (!$data['row']) {
		// 	return redirect()->route('admin.paginas.eventos.index');
		// }

		$data['posts'] = $inscricao->getInscritos($request->id);

		return view('admin.paginas.eventos.inscritos.index', $data);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, EventoModel $post)
	{

		if ($post->remove($request->id, 'post')) {
			$message = 'Postagem removida com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('admin.paginas.eventos.index')->with(['message' => $message]);

	}
}
