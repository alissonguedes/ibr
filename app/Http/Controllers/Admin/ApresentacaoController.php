<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApresentacaoRequest;
use App\Models\Admin\FileModel;
use App\Models\Admin\PostModel;
use Illuminate\Http\Request;

class ApresentacaoController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(PostModel $post) {

		$data['post'] = $post->getPost('apresentacao');

		return view('admin.home.apresentacao.index', $data);

	}

	/**
	 * Search banners
	 */
	public function search(Request $request, SobreModel $page) {

		$data['banners'] = SobreModel::where('titulo', 'like', $request->search . '%')->get();

		return view('admin.home.apresentacao.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request, PostModel $page) {

		// $data['id']      = $request->id;
		// $data['row']     = $page->getPost('id', $request->id);
		// $data['banners'] = SobreModel::all();

		// return view('admin.home.apresentacao.index', $data);

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(ApresentacaoRequest $request, PostModel $page) {

		$page->insert_or_update($request);

		if ($request->_method === 'put') {
			$message = 'Sobre atualizado com sucesso!';
		} else {
			$message = 'Sobre cadastrado com sucesso!';
		}

		return redirect()->route('admin.home.apresentacao.index')->with(['message' => $message]);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id) {

		return $file->showFile($file_id, 'post');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, PostModel $page) {

		return $page->remove($request->id);

	}
}
