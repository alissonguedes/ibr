<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MinisterioModel extends PostModel
{

	use HasFactory;

	protected $table = 'tb_post';

	// protected $fillable = [
	// 	'nome',
	// 	'status',
	// ];

	public function getAllMinisterios()
	{
		return $this->select(
			$this->columns
		)
			->where('tipo', 'ministerio')
			->get();
	}

	public function getMinisterio($data)
	{
		return $this->getOrWhere(['id', $data], ['titulo', $data])
			->first();
	}

	// public function search($search, $both = true)
	// {
	// 	return $this->whereAny([
	// 		'id',
	// 		'nome',
	// 	], 'like', ($both ? '%' : null) . $search . '%')
	// 		->get();

	// }

	// public function insert_or_update($request)
	// {

	// 	$columns           = [];
	// 	$data              = request()->all();
	// 	$columns['tipo']   = 'ministerio';
	// 	$columns['nome']   = $data['nome'];
	// 	$columns['status'] = $data['status'] ?? '0';
	// 	$imagem            = $request->file('imagem');
	// 	$where             = ['id' => $data['id'] ?? null];

	// 	$id_ministerio = $this->updateOrCreate($where, $columns);

	// 	FileModel::addAttachments($imagem, $id_ministerio->id);

	// 	return true;

	// }

	// public static function remove($id, $tipo = 'ministerios')
	// {

	// 	FileModel::remove($id, 'ministerio');

	// 	self::where('id', $id)->delete();

	// 	return true;

	// }

}
