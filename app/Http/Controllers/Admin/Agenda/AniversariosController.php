<?php

namespace App\Http\Controllers\Admin\Agenda;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Agenda\AgendaAniversarioRequest;
use App\Models\Admin\AgendaModel;
use App\Models\Admin\InscricaoModel;
use Illuminate\Http\Request;

class AniversariosController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, AgendaModel $post, InscricaoModel $inscricao)
	{

		$data['posts'] = $post->where('tipo', 'aniversario')->orderBy('data', 'ASC')->get();
		$data['row']   = $post->getEvento($request->id);

		// Pesquisar agendamentos
		if ($request->ajaxCalendar) {
			return response(view('admin.paginas.agenda.json', $data), 200);
		} else {
			return view('admin.paginas.agenda.aniversarios.index', $data);
		}

	}

	/**
	 * Search banners
	 */
	public function search(Request $request, AgendaModel $post)
	{

		// $data['posts'] = $post->search($request->search);
		$data['posts'] = $post->select('*')->where('titulo', 'like', '%' . $request->search . '%')->get();

		return view('admin.paginas.agenda.cultos.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(AgendaRequest $request)
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(AgendaAniversarioRequest $request, AgendaModel $agenda)
	{

		$data                          = $request->all();
		$dias_semana                   = ['domingo' => 0, 'segunda' => 1, 'terca' => 2, 'quarta' => 3, 'quinta' => 4, 'sexta' => 5, 'sabado' => 6];
		$data['data']                  = date('Y-m-d', strtotime(str_replace('/', '-', $data['data'])));
		$data['tempo_max_agendamento'] = $request->tempo_max_agendamento ?? null;
		$data['tempo_min_agendamento'] = $request->tempo_min_agendamento ?? null;
		$data['intervalo']             = $request->intervalo ?? null;
		$data['max_agendamento']       = $request->max_agendamento ?? null;

		unset($data['_token'], $data['_method'], $data['hora_inicio'], $data['hora_fim'], $data['categoria'], $data['medico'], $data['clinica']);

		switch ($request->_method) {
			default:
			case 'post':
				$agenda->insert($data);
				break;
			case 'put':
				$agenda->where('id', $request->id)->update($data);
				break;
		}

		return redirect()->route('admin.paginas.agenda.aniversarios.index')->with(['message' => 'Agenda atualizada com sucesso!']);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		//
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

		return redirect()->route('admin.paginas.agenda.aniversarios.index')->with(['message' => $message]);

	}

}
