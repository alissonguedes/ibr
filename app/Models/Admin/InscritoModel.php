<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class InscritoModel extends Model {
	use HasFactory;

	protected $table    = 'tb_inscrito';
	protected $fillable = ['id_uf', 'id_cidade', 'nome', 'cpf', 'rg', 'email', 'telefone', 'created_at', 'updated_at'];
	protected $datamap  = [
		// 'id_igreja'      => 'denominacao_id',
		// 'denominacao_id' => 'id_igreja',
		// 'funcao_id'      => 'id_funcao',
		'uf'     => 'id_uf',
		'cidade' => 'id_cidade',
	];

	public function fields(string $key) {

		if (empty($this->datamap)) {
			return $key;
		}

		if (! empty($this->datamap[$key])) {
			return $this->datamap[$key];
		}

		return $key;

	}

	public function map($field) {

		$data = [];

		unset($field['id']);
		unset($field['_token']);
		unset($field['_method']);

		foreach ($field as $i => $v) {

			$k = $this->fields($i);

			$data[$k] = $v;

		}

		return $data;

	}

}
