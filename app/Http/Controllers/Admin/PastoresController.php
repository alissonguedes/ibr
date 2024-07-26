<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PastorRequest;
use App\Models\Admin\FileModel;
use App\Models\Admin\PastorModel;
use Illuminate\Http\Request;

class PastoresController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, PastorModel $pastor)
	{

		$data['pastores'] = $pastor->getAllPastores();

		return view('admin.paginas.home.pastores.index', $data);

	}

	/**
	 * Search pastores
	 */
	public function search(Request $request, PastorModel $pastor)
	{

		$data['pastores'] = $pastor->search($request->search);

		return view('admin.paginas.home.pastores.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request, PastorModel $pastor)
	{

		$data['id']       = $request->id;
		$data['row']      = $pastor->getPastor($request->id);
		$data['pastores'] = $pastor->getAllPastores();

		return view('admin.paginas.home.pastores.index', $data);

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(PastorRequest $request, PastorModel $pastor)
	{

		$message = $pastor->insert_or_update($request);

		if ($message) {
			if ($request->_method === 'put') {
				$message = 'Pastor atualizado com sucesso!';
			} else {
				$message = 'Pastor cadastrado com sucesso!';
			}
		} else {
			$message = 'Houve um erro ao inserir os dados.';
		}

		return redirect()->route('admin.paginas.home.pastores.index')->with(['message' => $message]);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id)
	{

		return $file->showFile($file_id, 'pastor');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, PastorModel $pastor)
	{

		if ($pastor->remove($request->id)) {
			$message = 'Pastor removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('admin.paginas.home.pastores.index')->with(['message' => $message]);

	}
}
