<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Admin\MinisterioModel;
use App\Models\Admin\PostModel;

class MinisteriosController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index(PostModel $post) {

		$data['posts'] = $post->getAllPosts('ministerio');

		return view('main.ministerios.index', $data);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(MinisterioModel $ministerio) {
		echo '==> ';
	}

}
