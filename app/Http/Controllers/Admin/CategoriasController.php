<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoriaRequest;
use App\Models\Admin\CategoriaModel;
use App\Models\Admin\FileModel;
use Illuminate\Http\Request;

class CategoriasController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(CategoriaModel $categoria) {

		$data['categorias'] = $categoria->getAllCategorias();

		return view('admin.categorias.index', $data);

	}

	/**
	 * Search categorias
	 */
	public function search(Request $request, CategoriaModel $categoria) {

		$data['categorias'] = $categoria->search($request->search);

		return view('admin.categorias.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request, CategoriaModel $categoria) {

		$data['id']         = $request->id;
		$data['row']        = $categoria->getCategoria($request->id);
		$data['categorias'] = $categoria->getAllCategorias();

		return view('admin.categorias.index', $data);

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(CategoriaRequest $request, CategoriaModel $categoria) {

		if ($categoria->insert_or_update($request)) {

			if ($request->_method === 'put') {
				$message = 'Categoria atualizado com sucesso!';
			} else {
				$message = 'Categoria cadastrado com sucesso!';
			}

		} else {
			$message = 'Houve um erro ao inserir os dados.';
		}

		return redirect()->route('admin.categorias.index')->with(['message' => $message]);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id) {

		return $file->showFile($file_id, 'categoria');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, CategoriaModel $categoria) {

		if ($categoria->remove($request->id, 'categoria')) {
			$message = 'Categoria removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('admin.categorias.index')->with(['message' => $message]);

	}
}
