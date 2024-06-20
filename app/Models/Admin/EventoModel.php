<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * A classe extende de PostModel, pois opera na tabela `tb_post`
 */
class EventoModel extends Model
{

	use HasFactory;

	protected $table = 'tb_evento';

	protected $fillable = [
		'id_parent',
		'tipo',
		'autor',
		'titulo',
		'titulo_slug',
		'subtitulo',
		'conteudo',
		'tags',
		'url',
		'hits',
		'ordem',
		'publish_up',
		'publish_down',
		'id_file',
		'id_chunk',
		'filedata',
		'key',
		'signature',
		'imagem',
		'imgname',
		'imgtype',
		'imgsize',
		'autor',
		'ordem',
		'tags',
		'hits',
		'url',
		'publicar_ini',
		'publicar_fim',
		'created_at',
		'updated_at',
		'status',
	];

	public function getAllEventos()
	{
		return $this->all();
		// $container = 'eventos';
		// return $this->where(['tipo' => 'post'])->whereIn('id_parent', function ($query) use ($container) {
		// 	$query->select('id')->from('tb_post')->where('titulo_slug', $container);
		// })->get();
	}

	public function search($search, $both = true, $categoria = 'evento', $tipo = 'post')
	{

		// return $this->select($this->columns)->where('categoria', $categoria)
		// 	->whereAny([
		// 		'id',
		// 		'titulo',
		// 		'subtitulo',
		// 		'conteudo',
		// 	], 'like', ($both ? '%' : null) . $search . '%')
		// 	->whereNotNull('id_parent')
		// 	->get();

	}

	public function insert_or_update($request)
	{

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

		if (!isset($tipo)) {
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
		$columns['tags']         = $data['tags'] ?? null;
		$columns['publish_up']   = $data['publish_up'] ?? null;
		$columns['publish_down'] = $data['publish_down'] ?? null;
		$columns['status']       = $data['status'] ?? '0';
		$imagem                  = $request->file('imagem');
		$where                   = !isset($data['id']) ? [
			'categoria'   => $data['categoria'],
			'titulo_slug' => replace($data['titulo']),
		] : ['id' => $data['id']];

		$id_banner = PostModel::updateOrCreate($where, $columns);

		FileModel::addAttachments($imagem, $id_banner->id);

		return true;

	}

	public static function remove($id, $categoria = 'post')
	{

		FileModel::remove($id, $categoria);
		self::where('id', $id)->delete();

		return true;

	}

}
