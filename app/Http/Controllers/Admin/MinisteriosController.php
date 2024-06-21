<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MinisterioRequest;
use App\Models\Admin\FileModel;
use App\Models\Admin\MinisterioModel;
use Illuminate\Http\Request;

class MinisteriosController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index(MinisterioModel $ministerio) {

		$data['posts'] = $ministerio->getAllMinisterios('ministerio');

		return view('admin.paginas.ministerios.index', $data);

	}

	/**
	 * Search ministerios
	 */
	public function search(Request $request, MinisterioModel $ministerio) {

		$data['ministerios'] = $ministerio->search($request->search);

		return view('admin.paginas.ministerios.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request, MinisterioModel $ministerio) {

		$data['id']          = $request->id;
		$data['row']         = $ministerio->getPost($request->id);
		$data['ministerios'] = $ministerio->getAllMinisterios();

		return view('admin.paginas.ministerios.index', $data);

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(MinisterioRequest $request, MinisterioModel $ministerio) {

		$message = $ministerio->insert_or_update($request);

		if ($message) {
			if ($request->_method === 'put') {
				$message = 'Ministerio atualizado com sucesso!';
			} else {
				$message = 'Ministerio cadastrado com sucesso!';
			}
		} else {
			$message = 'Houve um erro ao inserir os dados.';
		}

		return redirect()->route('admin.paginas.ministerios.index')->with(['message' => $message]);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id) {

		return $file->showFile($file_id, 'ministerio');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, MinisterioModel $ministerio) {

		if ($ministerio->remove($request->id, 'ministerio')) {
			$message = 'Ministerio removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('admin.paginas.ministerios.index')->with(['message' => $message]);

	}
}
