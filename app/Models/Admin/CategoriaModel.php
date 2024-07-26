<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * A classe extende de PostModel, pois opera na tabela `tb_post`
 */
class CategoriaModel extends Model
{

	use HasFactory;

	protected $table = 'tb_categoria';

	protected $fillable = [
		'id_parent',
		'titulo',
		'titulo_slug',
		'descricao',
		'icone',
		'color',
		'text_color',
		'status',
		'created_at',
		'updated_at',
	];

	public function insert_or_update($request)
	{

		$columns = [];
		$data    = request()->all();

		$columns['id_parent']   = $data['id_parent'] ?? $id_parent->id ?? null;
		$columns['titulo']      = $data['titulo'];
		$columns['titulo_slug'] = $data['titulo_slug'] ?? replace($data['titulo']);
		$columns['descricao']   = $data['descricao'] ?? null;
		$columns['icone']       = $data['icone'] ?? null;
		$columns['color']       = $data['color'] ?? null;
		$columns['text_color']  = $data['text_color'] ?? null;
		$columns['status']      = $data['status'] ?? '0';
		$where                  = !isset($data['id']) ? [
			'titulo_slug' => $data['titulo_slug'],
		] : ['id' => $data['id']];

		$this->updateOrCreate($where, $columns);

		return true;

	}

	public function getAllCategorias()
	{
		return $this->where('id_parent', null)->orderBy('titulo', 'asc')->get();
	}

	public function getActiveCategorias($container = 'slideshow-container')
	{
		return $this->getAllCategorias($container)->where('status', '1')->orderBy('titulo', 'asc');
	}

	public function getCategoria($data)
	{
		return $this->getOrWhere(['id', $data], ['titulo_slug', $data])->first();
	}

	public function getTotalCategorias()
	{
		return $this->count();
	}

	public function search($search, $both = true, $categoria = 'categoria', $tipo = 'post')
	{
		return $this->where('titulo', 'like', '%' . $search . '%')->get();
	}

	public static function remove($id)
	{

		self::where('id', $id)->delete();

		return true;

	}

}
