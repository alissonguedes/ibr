<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class PastorModel extends Model {

	use HasFactory;

	protected $table = 'tb_pastor';

	protected $fillable = [
		'nome',
		'status',
	];

	protected $columns = ['id', 'nome', 'status'];

	public function getAllPastores() {
		return $this->select(
			'id', 'nome', DB::raw('IF(status = "1", "Ativo", "Inativo") AS status')
		)->get();
	}

	public function getPastor($data) {
		return $this->getOrWhere(['id', $data], ['nome', $data])
			->first();
	}

	public function search($search, $both = true, $categoria = 'pastor', $tipo = 'post') {
		return $this->whereAny([
			'id',
			'nome',
		], 'like', ($both ? '%' : null) . $search . '%')
			->get();

	}

	public function getAllActivePosts($categoria = 'pastor', $limit = 50, $options = []) {

		$allPosts = $this->where('status', '1')->limit($limit);

		if ($limit > 1) {
			return $allPosts->get();
		}

		return $allPosts->first();

	}

	public function insert_or_update($request) {

		$columns           = [];
		$data              = request()->all();
		$columns['tipo']   = 'pastor';
		$columns['nome']   = $data['nome'];
		$columns['status'] = $data['status'] ?? '0';
		$imagem            = $request->file('imagem');
		$where             = ['id' => $data['id'] ?? null];

		$id_pastor = $this->updateOrCreate($where, $columns);

		FileModel::addAttachments($imagem, $id_pastor->id);

		return true;

	}

	public static function remove($id) {

		FileModel::remove($id, 'pastor');

		self::where('id', $id)->delete();

		return true;

	}

}
