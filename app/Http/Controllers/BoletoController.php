<?php
namespace App\Http\Controllers;

use App\Models\Admin\EventoModel;
use App\Models\Admin\InscricaoModel;
use App\Models\Admin\InscritoModel;
use App\Models\BoletoModel;
use Illuminate\Http\Request;

class BoletoController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function gerarBoleto(InscricaoModel $inscricaoModel, EventoModel $eventoModel, InscritoModel $inscritoModel) {

		$evento = $eventoModel->select('evento', 'valor')->where('id', $eventoModel->id)->first();

		$request = new Request();
		$request->validate([
			// 'valor'      => 'required|numeric',
			// 'vencimento' => 'required|date',
			// 'pagador'    => 'required|array',
		]);

		$pagador = $inscritoModel->setConnection('site')
			->select('nome', 'cpf', 'email', 'rg', 'telefone', 'id_cidade', 'id_uf')
			->where('id', $inscricaoModel->id_inscrito)
			->first();

		$beneficiary = ['nome' => 'IGREJA BATISTA RENOVADA', 'cpf' => '86049253099', 'tipo' => 'person'];
		$pagador     = ['nome' => $pagador->nome, 'cpf' => $pagador->cpf, 'tipo' => 'person', 'email' => $pagador->email];

		$dadosBoleto = [
			'beneficiary' => $beneficiary,
			'payee'       => $pagador,
			'valor'       => $evento->valor,
		];

		$boletoModel = new BoletoModel();
		$boleto      = $boletoModel->emitirBoleto($dadosBoleto);
		$boletoModel->cadastraBoleto($boleto, $inscricaoModel);

		// return redirect()->route('site.eventos.boleto.show', ['boleto' => $boleto->getPaymentInformation()->getBarCode()]);

		return view('main.eventos.boleto', ['boleto' => $boleto]);

	}

	public function barCode(Request $request, BoletoModel $boletoModel) {

		return $boletoModel->gerarBarCode($request);

	}

	public function qrCode(Request $request, BoletoModel $boletoModel) {

		return $boletoModel->gerarQrCode($request);

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request, BoletoModel $boletoModel) {
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, BoletoModel $boleto) {

		return 'teste';
		// $boleto = $request->boleto;
		// 74897937700000099891122224595067890312345109
		dd($request);
		// return view('main.eventos.boleto', );

	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id) {
		//
	}
}
