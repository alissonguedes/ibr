<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\FileModel;
use App\Models\Admin\PostModel;
use Illuminate\Http\Request;

class PostsController extends Controller
{

	protected $categoria = 'post';

	public function __construct(Request $request, PostModel $post)
	{

		if ($request->user()->cannot('view', [$post, $this->categoria])) {
			abort(403);
		}

	}
	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id)
	{

		return $file->showFile($file_id, 'post');

	}

}
