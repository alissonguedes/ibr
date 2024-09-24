<?php

namespace App\Http\Controllers\Admin\Agenda;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Agenda\AgendaCultoRequest;
use App\Models\Admin\AgendaModel;
use App\Models\Admin\InscricaoModel;
use Illuminate\Http\Request;

class CultosController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, AgendaModel $post, InscricaoModel $inscricao)
	{

		$data['posts'] = $post->where('tipo', 'culto')->orderBy('data_hora', 'ASC')->get();
		$data['row']   = $post->getEvento($request->id);

		// Pesquisar agendamentos
		if ($request->ajaxCalendar) {
			return response(view('admin.paginas.agenda.json', $data), 200);
		} else {
			return view('admin.paginas.agenda.cultos.index', $data);
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
	public function store(AgendaCultoRequest $request, AgendaModel $agenda)
	{

		$data                          = $request->all();
		$dias_semana                   = ['domingo' => 0, 'segunda' => 1, 'terca' => 2, 'quarta' => 3, 'quinta' => 4, 'sexta' => 5, 'sabado' => 6];
		$horarios                      = $data['horario'];
		$data['data_hora']             = [];
		$data['tempo_max_agendamento'] = $request->tempo_max_agendamento ?? null;
		$data['tempo_min_agendamento'] = $request->tempo_min_agendamento ?? null;
		$data['intervalo']             = $request->intervalo ?? null;
		$data['max_agendamento']       = $request->max_agendamento ?? null;

		unset($data['_token'], $data['_method'], $data['horario'], $data['categoria'], $data['medico'], $data['clinica']);

		if (isset($horarios)) {

			$data_hora = [];

			foreach ($horarios as $dia => $horario) {

				$timerange = [];
				$dia       = $dias_semana[$dia];
				$hora      = array_combine($horario['inicio'], $horario['fim']);

				foreach ($hora as $inicio => $fim) {

					$ini_format          = (preg_match('/^[0-9]{2}\:[0-9]{2}$/', $inicio) ? $inicio : $inicio . ':00') . ':00';
					$fim_format          = (preg_match('/^[0-9]{2}\:[0-9]{2}$/', $fim) ? $fim : $fim . ':00') . ':00';
					$timerange['inicio'] = $ini_format;
					$timerange['fim']    = $fim_format;

					$data_hora[$dia][] = $timerange;

				}

				$data['data_hora'] = json_encode($data_hora);

			}

		}

		switch ($request->_method) {
			default:
			case 'post':
				$agenda->insert($data);
				break;
			case 'put':
				$agenda->where('id', $request->id)->update($data);
				break;
		}

		return redirect()->route('admin.paginas.agenda.cultos.index')->with(['message' => 'Agenda atualizada com sucesso!']);

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

		return redirect()->route('admin.paginas.agenda.cultos.index')->with(['message' => $message]);

	}

}
