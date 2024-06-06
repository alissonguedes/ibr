<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CultoRequest;
use App\Models\Admin\CultoModel;
use App\Models\Admin\FileModel;
use App\Models\Admin\PostModel;
use Illuminate\Http\Request;

class CultosController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(CultoModel $post)
	{

		$data['posts'] = $post->getAllPosts('culto');

		return view('admin.paginas.cultos.index', $data);

	}

	/**
	 * Search banners
	 */
	public function search(Request $request, PostModel $post)
	{

		$data['posts'] = $post->search($request->search);

		return view('admin.paginas.cultos.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request, PostModel $post)
	{

		$data['id']    = $request->id;
		$data['row']   = $post->getPost($request->id);
		$data['posts'] = $post->getAllPosts('culto');

		if (!$data['row']) {
			return redirect()->route('admin.paginas.cultos.index');
		}

		return view('admin.paginas.cultos.index', $data);

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(CultoRequest $request, PostModel $page)
	{

		$page->insert_or_update($request);

		if ($request->_method === 'put') {
			$message = 'Sobre atualizado com sucesso!';
		} else {
			$message = 'Sobre cadastrado com sucesso!';
		}

		return redirect()->route('admin.paginas.cultos.index')->with(['message' => $message]);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id)
	{

		return $file->showFile($file_id, 'culto');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, PostModel $post)
	{

		if ($post->remove($request->id, 'culto')) {
			$message = 'Postagem removida com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('admin.paginas.cultos.index')->with(['message' => $message]);

	}
}
