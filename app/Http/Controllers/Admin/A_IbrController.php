<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\A_IbrRequest;
use App\Models\Admin\FileModel;
use App\Models\Admin\PostModel;
use Illuminate\Http\Request;

class A_IbrController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(PostModel $post)
	{

		$data['posts'] = $post->getAllPosts('a-ibr');

		return view('admin.paginas.a-ibr.index', $data);

	}

	/**
	 * Search banners
	 */
	public function search(Request $request, PostModel $post)
	{

		$data['posts'] = $post->search($request->search, true);

		return view('admin.paginas.a-ibr.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request, PostModel $post)
	{

		$data['id']    = $request->id;
		$data['row']   = $post->getPost($request->id);
		$data['posts'] = $post->getAllPosts('a-ibr');

		if (!$data['row']) {
			return redirect()->route('admin.paginas.a-ibr.index');
		}

		return view('admin.paginas.a-ibr.index', $data);

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(A_IbrRequest $request, PostModel $page)
	{

		$page->insert_or_update($request);

		if ($request->_method === 'put') {
			$message = 'Sobre atualizado com sucesso!';
		} else {
			$message = 'Sobre cadastrado com sucesso!';
		}

		return redirect()->route('admin.paginas.a-ibr.index')->with(['message' => $message]);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id)
	{

		return $file->showFile($file_id, 'post');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, PostModel $post)
	{

		if ($post->remove($request->id, 'post')) {
			$message = 'Postagem removida com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('admin.paginas.a-ibr.index')->with(['message' => $message]);

	}
}
