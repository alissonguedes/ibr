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
		'categoria',
		'autor',
		'titulo',
		'titulo_slug',
		'subtitulo',
		'conteudo',
		'data',
		'tags',
		'url',
		'texto_url',
		'hits',
		'ordem',
		'status',
		'publish_up',
		'publish_down',
	];

	protected $columns = ['id', 'tipo', 'autor', 'titulo', 'titulo_slug', 'subtitulo', 'conteudo', 'data', 'tags', 'url', 'texto_url', 'hits', 'publish_up', 'publish_down', 'status'];

	public function search($search, $both = true, $categoria = 'post', $tipo = 'post') {

		return $this->select($this->columns)
			->where('tipo', $tipo)
			->where('categoria', $categoria)
			->whereAny([
				'id',
				'titulo',
				'subtitulo',
				'conteudo',
			], 'like', ($both ? '%' : null) . $search . '%')
		// ->whereNotNull('id_parent')
			->get();

	}

	public function getAllPosts($where = null, $categoria = 'post') {

		$get = $this->select($this->columns);

		if (! empty($where)) {
			$get->where(function ($get) use ($where) {
				$get->orWhere('id', $where);
				$get->orWhere('categoria', $where);
				$get->orWhere('titulo_slug', $where);
			});
		}

		$get->where('tipo', $categoria);

		return $get->get();

	}

	public function getPost($data) {
		return $this->whereAny(['id', 'categoria', 'titulo_slug'], $data)
			->select($this->columns ?? '*')
			->where('tipo', 'post')->first();
	}

	public function getPermissao($categoria) {

		return $this->select('permissao')
			->from('tb_usuario_permissao as P')
			->join('tb_categoria as C', 'C.id', 'P.id_categoria')
			->join('tb_usuario AS U', 'U.id', 'P.id_usuario')
			->where('P.id_categoria', function ($query) use ($categoria) {
				$query->select('id')->from('tb_categoria')
					->whereColumn('P.id_categoria', 'C.id')
					->where('titulo_slug', $categoria);
			})
			->where('U.id', Auth::user()->nivel)
			->whereColumn('U.id', 'P.id_usuario')
			->get();

	}

	public function getAllActivePosts($categoria, $limit = 50, $options = []) {

		if (! isset($options['table'])) {
			$options['table'] = 'tb_post';
		}

		$allPosts = $this->from($options['table']);

		if ($options['table'] === 'tb_post') {
			$allPosts->where('tipo', 'post');
			$allPosts->where('categoria', $categoria);
		}

		$allPosts = $allPosts->where('status', '1')->limit($limit);

		if ($limit > 1) {
			return $allPosts->get();
		}

		return $allPosts->first();

	}

	public function getActivePost($container) {
		return $this->getAllPosts($container)->where('status', '1')->first();
	}

	public function insert_or_update($request) {

		$columns = [];
		$data    = request()->all();

		$id_parent = $this->select('id')->where('categoria', $data['categoria'])->where('id_parent', null)->get()->first();

		$tipo = $this->select('titulo', 'titulo_slug')
			->from('tb_categoria')
			->whereAny(
				[
					'titulo',
					'titulo_slug',
				], '=', $data['tipo']
			)
			->get()->first();

		if (! isset($tipo)) {
			CategoriaModel::insert([
				'titulo'      => $data['tipo'],
				'titulo_slug' => replace($data['tipo'], '-'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
			]);
		}

		$columns['tipo']         = $data['tipo'] ?? 'post';
		$columns['id_parent']    = $data['id_parent'] ?? $id_parent->id ?? null;
		$columns['categoria']    = $data['categoria'] ?? null;
		$columns['autor']        = Auth::id();
		$columns['titulo']       = $data['titulo'];
		$columns['titulo_slug']  = $data['titulo_slug'] ?? replace($data['titulo'], '-');
		$columns['subtitulo']    = $data['subtitulo'] ?? null;
		$columns['conteudo']     = $data['conteudo'] ?? null;
		$columns['data']         = isset($data['data']) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['data']))) : null;
		$columns['ordem']        = $data['ordem'] ?? 0;
		$columns['url']          = $data['url'] ?? null;
		$columns['texto_url']    = $data['texto_url'] ?? null;
		$columns['tags']         = $data['tags'] ?? null;
		$columns['publish_up']   = $data['publish_up'] ?? null;
		$columns['publish_down'] = $data['publish_down'] ?? null;
		$columns['status']       = $data['status'] ?? '0';
		$imagem                  = $request->file('imagem');
		$where                   = ! isset($data['id']) ? [
			'categoria'   => $data['categoria'],
			'titulo_slug' => replace($data['titulo']),
		] : ['id' => $data['id']];

		$id_banner = PostModel::updateOrCreate($where, $columns);

		FileModel::addAttachments($imagem, $id_banner->id);

		return true;

	}

	public static function remove($id, $categoria = 'post') {

		FileModel::remove($id, $categoria);
		self::where('id', $id)->delete();

		return true;

	}

}
