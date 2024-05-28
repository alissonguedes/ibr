<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * A classe extende de PostModel, pois opera na tabela `tb_post`
 */
class CategoriaModel extends PostModel {

	use HasFactory;

	// protected $table = 'tb_categoria';

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

	public function getAllCategorias($container = 'slideshow-container') {
		return $this->where(['tipo' => 'categoria'])->where('id_parent', function ($query) use ($container) {
			$query->select('id')->from('tb_post')->where('titulo_slug', $container);
		})->get();
	}

	public function getActiveCategorias($container = 'slideshow-container') {
		return $this->getAllCategorias($container)->where('status', '1');
	}

	public function getCategoria($data) {
		return $this->getOrWhere(['id', $data], ['titulo_slug', $data])->where('tipo', 'categoria')->first();
	}

	public function getTotalCategorias() {
		return $this->where('tipo', 'categoria')->whereNot('id_parent', null)->count();
	}

	public function search($search, $tipo = 'categoria', $both = true) {
		return parent::search($search, $tipo, $both);
	}

}
