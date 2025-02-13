<?php
namespace App\Http\Controllers\Main;

use App\Http\Controllers\BoletoController;
use App\Http\Controllers\Controller;
use App\Http\Requests\InscricoesRequest;
use App\Models\Admin\EventoModel;
use App\Models\Admin\InscricaoModel;
use App\Models\Admin\InscritoModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class InscricoesController extends Controller {

	public function index(Request $request, EventoModel $eventoModel, string $evento) {

		$data['id']   = $request->id;
		$data['post'] = $eventoModel->getEventoByTitulo($evento);

		$db              = DB::connection('site');
		$data['estados'] = $db->table('tb_estado')->where('id_pais', function ($db) {
			$db->select('id')
				->from('tb_pais')
				->whereColumn('id', 'id_pais')
				->where('codigo', 'BR');
		})->get();

		$data['cidades'] = $db->table('tb_cidade')->where('id_estado', function ($db) {
			$db->select('id')
				->from('tb_estado')
				->whereColumn('id', 'id_estado')
				->where('estado', 'Paraiba');
		})->get();

		if (! isset($data['post'])) {
			return redirect()->route('site.eventos');
		}

		return view('main.eventos.details', $data);
	}

	// /**
	//  * Display a listing of the resource.
	//  */
	// public function index(Request $request)
	// {

	// 	if ($request->ajax()) {
	// 		$request->session()->regenerate();
	// 		$id = session()->get('_token');
	// 		return response()->json($id);
	// 	}

	// 	$id              = $request->evento;
	// 	$data['igrejas'] = IgrejaModel::all();
	// 	$data['funcoes'] = FuncaoModel::all();
	// 	$evento          = EventoModel::where('id', function ($db) use ($id) {
	// 		$db->select('id')->where('evento_slug', $id);
	// 	})->get()->first();

	// 	if (!isset($evento)) {
	// 		return redirect()->route('eventos.index');
	// 	}
	// 	$data['evento']  = $evento;
	// 	$data['estados'] = DB::table('tb_estado')->where('id_pais', function ($db) {
	// 		$db->select('id')
	// 			->from('tb_pais')
	// 			->whereColumn('id', 'id_pais')
	// 			->where('codigo', 'BR');
	// 	})->get();
	// 	$data['cidades'] = DB::table('tb_cidade')->where('id_estado', function ($db) {
	// 		$db->select('id')
	// 			->from('tb_estado')
	// 			->whereColumn('id', 'id_estado')
	// 			->where('estado', 'Paraiba');
	// 	})->get();

	// 	return view('eventos.inscricoes', $data);

	// }

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(InscricoesRequest $request, BoletoController $boleto) {

		$cpf         = replace($request->cpf);
		$rg          = replace($request->rg);
		$data_viagem = $request->data_viagem && $request->hora_viagem && $request->minuto_viagem ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->data_viagem . ' ' . $request->hora_viagem . ':' . $request->minuto_viagem . ':00'))) : null;

		$db_inscrito = InscritoModel::select(
			'id', 'nome', 'email', 'telefone', 'id_uf', 'id_cidade',
			DB::raw('REGEXP_REPLACE(cpf, "[^\\x20-\\x7E]", "") AS cpf')
		)->where(DB::raw('REGEXP_REPLACE(cpf, "[^\\x20-\\x7E]", "")'), $cpf)
			->get()->first();

		$inscrito_data = [
			'cpf'       => $cpf,
			'rg'        => $rg,
			'nome'      => $request->nome,
			'email'     => $request->email,
			'telefone'  => $request->telefone,
			'id_uf'     => $request->uf,
			'id_cidade' => $request->cidade,
		];

		if (isset($db_inscrito)) {
			$inscrito_data['cpf'] = $db_inscrito->cpf;
			InscritoModel::where('id', $db_inscrito->id)->update($inscrito_data);
			$inscritoModel = $db_inscrito;
		} else {
			$inscritoModel = InscritoModel::create($inscrito_data);
		}

		$inscricao_inscrito = InscricaoModel::where(['id_inscrito' => $inscritoModel->id, 'id_evento' => $request->evento])->first();

		$where_inscricao = ['id_evento' => $request->evento, 'id_inscrito' => $inscritoModel->id];
		$data_inscricao  = [
			'id_evento'   => $request->evento,
			'id_inscrito' => $inscritoModel->id,
		];

		$inscricaoExists = InscricaoModel::where($where_inscricao)->first();

		if (! $inscricaoExists) {
			$data_inscricao['codigo_inscricao'] = uniqid(rand(111111, 999999));
		}

		$inscricaoModel = InscricaoModel::updateOrCreate($where_inscricao, $data_inscricao);

		$eventoModel = EventoModel::where('id', $request->evento)->first();

		$boleto = $boleto->gerarBoleto($inscricaoModel, $eventoModel, $inscritoModel);

		return $boleto;
		// return redirect()->route('site.eventos.boleto')->withInput(['boleto' => $boleto]);

		if (isset($inscricao_inscrito)) {
			// return redirect()->route('site.eventos.inscricoes', ['evento' => $eventoModel->evento_slug, 'boleto' => $inscricaoModel])->with(['message' => 'Sua inscrição foi atualizada.']);
		}

		// return redirect()->route('site.eventos.inscricoes', ['evento'=> $eventoModel->evento_slug, 'boleto' => $inscricaoModel])->with(['message' => 'Inscrição enviada com sucesso!']);

		// return ['boleto' => $inscricaoModel];

	}

	// public function create_boleto() {
	// (new Beneficiary(
	// 	'Jose da Silva',
	// 	'86049253099',
	// 	'person'
	// ))(new Payee(
	// 	'Maria de Lurdes',
	// 	'50581718054',
	// 	'person'
	// ))
	// }

	/**
	 * Display the specified resource.
	 */
	public function show(InscricoesModel $inscricoesModel) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Request $request, InscricaoModel $inscricao) {

		$data   = [];
		$cpf    = $request->cpf;
		$evento = $request->evento;

		$inscrito  = InscritoModel::where(DB::raw('REGEXP_REPLACE(cpf, "[^\\x20-\\x7E]", "")'), $cpf)->get()->first();
		$inscricao = InscricaoModel::where(['id_inscrito' => $inscrito->id, 'id_evento' => $evento])->first();

		if (isset($inscricao)) {
			$data = [
				'nome'     => $inscrito->nome,
				'cpf'      => limpa_string($inscrito->cpf),
				'email'    => $inscrito->email,
				'telefone' => $inscrito->telefone,
				'uf'       => $inscrito->id_uf,
				'cidade'   => $inscrito->id_cidade,
			];
		}

		return response()->json($data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, InscricoesModel $inscricoesModel) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(InscricoesModel $inscricoesModel) {
		//
	}
}
