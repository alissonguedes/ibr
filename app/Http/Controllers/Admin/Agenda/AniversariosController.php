<?php

namespace App\Http\Controllers\Admin\Agenda;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AgendaRequest;
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

		$data['posts'] = $post->where('tipo', 'A')->where('subtipo', 'aniversario')->get();
		$data['row']   = $post->getEvento($request->id);

		// Pesquisar agendamentos
		if ($request->ajaxCalendar) {
			return response(view('admin.paginas.agenda.json', $data), 200);
		} else {
			return view('admin.paginas.agenda.index', $data);
		}

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
	public function store(Request $request)
	{
		//
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
	public function destroy(string $id)
	{
		//
	}
}
