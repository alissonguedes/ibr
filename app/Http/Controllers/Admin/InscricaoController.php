<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model;
use Illuminate\Http\Request;

class InscricaoController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index() {

		$inscritoModel = new Model();

		$inscrito = $inscritoModel->setConnection('site')
			->select(
				'Inscricao.id AS idInscricao', 'Inscricao.id_evento AS evento', 'Inscricao.codigo_inscricao AS codigo', 'Inscricao.data_inscricao', 'Inscricao.data_pagamento', 'Inscricao.transaction_id', 'Inscricao.status',
				'Inscrito.id AS idInscrito', 'Inscrito.id_uf', 'Inscrito.id_cidade', 'Inscrito.nome', 'Inscrito.cpf', 'Inscrito.rg', 'Inscrito.email', 'Inscrito.telefone'
			)
			->from('tb_inscricao AS Inscricao')
			->join('tb_inscrito AS Inscrito', 'Inscrito.id', 'Inscricao.id_inscrito', 'left')
			->where('Inscricao.id', request('inscricao'))
			->get()
			->first();

		$dados['inscrito'] = $inscrito;

		return view('admin.paginas.eventos.inscricao.index', $dados);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id) {
		//
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
