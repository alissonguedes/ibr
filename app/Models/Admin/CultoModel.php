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
		return $this->where(['tipo' => 'post'])->whereIn('id_parent', function ($query) use ($container) {
			$query->select('id')->from('tb_post')->where('titulo_slug', $container);
		})->get();
	}

	public function getActiveBanners($container = 'slideshow-container') {
		return $this->getAllBanners($container)->where('status', '1');
	}

	public function getBanner($data) {
		return $this->getOrWhere(['id', $data], ['titulo_slug', $data])->where('tipo', 'banner')->first();
	}

	public function getTotalBanners() {
		return $this->where('tipo', 'banner')->whereNot('id_parent', null)->count();
	}

	public function search($search, $tipo = 'banner', $both = true) {
		return parent::search($search, $tipo, $both);
	}

}
