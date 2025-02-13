<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * A classe extende de PostModel, pois opera na tabela `tb_post`
 */
class CultoModel extends PostModel {

	use HasFactory;

	// protected $table = 'tb_banner';

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

	public function getAllCultos() {
		$container = 'cultos';
		dd($container);
		// return $this->where(['tipo' => 'post'])->whereIn('id_parent', function ($query) use ($container) {
		// 	$query->select('id')->from('tb_post')->where('titulo_slug', $container);
		// })->get();
		// return $this->get();
	}

	public function getCulto($data) {
		return $this->getOrWhere(['titulo_slug', $data])
			->first();
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

	public function search($search, $both = true, $categoria = 'culto', $tipo = 'post') {
		return parent::search($search, $both, $categoria, $tipo);
	}

}
