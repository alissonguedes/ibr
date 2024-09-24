<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Admin\AgendaModel;
use App\Models\Main\HomeModel;
use Illuminate\Http\Request;

class AgendaController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, AgendaModel $agenda)
	{

		$data['agenda'] = $agenda->where('tipo', '<>', 'culto')->orderBy('data_hora', 'ASC')->get();
		return view('main.agenda.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
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
	public function show(HomeModel $home)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(HomeModel $home)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, HomeModel $home)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(HomeModel $home)
	{
		//
	}

}
