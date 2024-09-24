<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AgendaRequest;
use App\Models\Admin\AgendaModel;
use App\Models\Admin\EventoModel;
use App\Models\Admin\InscricaoModel;
use App\Models\Admin\PostModel;
use Illuminate\Http\Request;

class AgendaController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, AgendaModel $post, InscricaoModel $inscricao)
	{

		$data['posts'] = $post->where('tipo', 'A')->get();
		$data['row']   = $post->getEvento($request->id);

		// Pesquisar agendamentos
		if ($request->ajaxCalendar) {
			return response(view('admin.paginas.agenda.json', $data), 200);
		} else {
			return view('admin.paginas.agenda.index', $data);
		}

	}

	/**
	 * Search banners
	 */
	public function search(Request $request, PostModel $post, InscricaoModel $inscricao)
	{

		$data['posts'] = $post->search($request->search, true, 'agendas');

		return view('admin.paginas.agenda.index-calendar', $data);

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
			return redirect()->route('admin.paginas.agenda.index-calendar');
		}

		return view('admin.paginas.agenda.index-calendar', $data);

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(AgendaRequest $request, AgendaModel $page)
	{

		$page->insert_or_update($request);

		if ($request->_method === 'put') {
			$message = 'Agenda atualizado com sucesso!';
		} else {
			$message = 'Agenda cadastrado com sucesso!';
		}

		return redirect()->route('admin.paginas.agenda.index')->with(['message' => $message]);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, AgendaModel $post, int $year, int $month, int $day)
	{

		$date                = $year . '-' . $month . '-' . $day;
		$data['eventos']     = $post->getAll();
		$data['eventos_dia'] = $post->getAll($date);

		if ($request->ajaxCalendar) {

			return response(view('admin.paginas.agenda.json', $data), 200);

		} else {

			return view('admin.paginas.agenda.index-calendar', $data);

		}

	}

	/**
	 * Display the especified resource.
	 */
	public function inscritos(Request $request, AgendaModel $post, InscricaoModel $inscricao)
	{

		$data['id']  = $request->id;
		$data['row'] = $post->getAgenda($request->id);

		$data['posts'] = $inscricao->getInscritos($request->id);

		return view('admin.paginas.agenda.inscritos.index', $data);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, AgendaModel $post)
	{

		if ($post->remove($request->id, 'post')) {
			$message = 'Postagem removida com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('admin.paginas.agenda.index')->with(['message' => $message]);

	}
}
