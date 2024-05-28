<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class PostModel extends Model {

	use HasFactory;

	protected $table = 'tb_post';
	protected $tipo  = 'post';

	protected $fillable = [
		'id_parent',
		'tipo',
		'autor',
		'titulo',
		'titulo_slug',
		'subtitulo',
		'conteudo',
		'data',
		'tags',
		'url',
		'hits',
		'ordem',
		'status',
		'publish_up',
		'publish_down',
	];

	protected $columns = ['id', 'tipo', 'autor', 'titulo', 'titulo_slug', 'subtitulo', 'conteudo', 'data', 'tags', 'url', 'hits', 'publish_up', 'publish_down', 'status'];

	public function search($search, $both = false, $tipo = 'post') {

		return $this->select($this->columns)->where('tipo', $tipo)
			->whereAny([
				'id',
				'titulo',
				'subtitulo',
				'conteudo',
			], 'like', ($both ? '%' : null) . $search . '%')
			->get();

	}

	public function getAllPosts($where = null, $tipo = 'post') {

		$get = $this->select($this->columns);

		if (!empty($where)) {
			$get->where(function ($get) use ($where) {
				$get->where('titulo_slug', $where);
				$get->orWhere('id', $where);
			});
		}

		$get->where('tipo', $tipo);

		return $get->get();

	}

	public function getPost($data) {
		return $this->getOrWhere(['titulo_slug', $data], ['id', $data])
			->select($this->columns ?? '*')
			->where('tipo', 'post')->first();
	}

	public function getAllActivePosts($container) {
		return $this->getAllPosts($container)->where('status', '1');
	}

	public function getActivePost($container) {
		return $this->getAllPosts($container)->where('status', '1')->first();
	}

	public function insert_or_update($request) {

		$columns = [];
		$data    = request()->all();

		$id_parent = $this->select('id')->where('tipo', $data['tipo'])->where('id_parent', null)->get()->first();

		$columns['id_parent']    = $data['id_parent'] ?? $id_parent->id ?? null;
		$columns['tipo']         = $data['tipo'] ?? 'F';
		$columns['autor']        = Auth::id();
		$columns['titulo']       = $data['titulo'];
		$columns['titulo_slug']  = $data['titulo_slug'] ?? replace($data['titulo']);
		$columns['subtitulo']    = $data['subtitulo'] ?? null;
		$columns['conteudo']     = $data['conteudo'] ?? null;
		$columns['data']         = isset($data['data']) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['data']))) : null;
		$columns['ordem']        = $data['ordem'] ?? 0;
		$columns['url']          = $data['url'] ?? null;
		$columns['tags']         = $data['tags'] ?? null;
		$columns['publish_up']   = $data['publish_up'] ?? null;
		$columns['publish_down'] = $data['publish_down'] ?? null;
		$columns['status']       = $data['status'] ?? '0';
		$imagem                  = $request->file('imagem');
		$where                   = !isset($data['id']) ? [
			'tipo'        => $data['tipo'],
			'titulo_slug' => replace($data['titulo']),
		] : ['id' => $data['id']];

		$id_banner = PostModel::updateOrCreate($where, $columns);

		FileModel::addAttachments($imagem, $id_banner->id);

		return true;

	}

	public static function remove($id, $tipo = 'post') {

		FileModel::remove($id, $tipo);
		self::where('id', $id)->delete();

		return true;

	}

}
