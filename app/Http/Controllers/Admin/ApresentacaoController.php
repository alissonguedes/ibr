<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApresentacaoRequest;
use App\Models\Admin\CategoriaModel;
use App\Models\Admin\FileModel;
use App\Models\Admin\PostModel;
use Illuminate\Http\Request;

class ApresentacaoController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(PostModel $post, CategoriaModel $categoria)
	{

		$data['categorias'] = $categoria->getAllCategorias();
		$data['post']       = $post->getPost('apresentacao');

		return view('admin.paginas.home.apresentacao.index', $data);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id)
	{

		return $file->showFile($file_id, 'apresentacao');

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(ApresentacaoRequest $request, PostModel $page)
	{

		$page->insert_or_update($request);

		if ($request->_method === 'put') {
			$message = 'Apresentação atualizada com sucesso!';
		} else {
			$message = 'Apresentação cadastrada com sucesso!';
		}

		return redirect()->route('admin.paginas.home.apresentacao.index')->with(['message' => $message]);

	}

}
