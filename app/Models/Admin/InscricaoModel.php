<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class InscricaoModel extends Model {
	use HasFactory;

	protected $table = 'tb_inscricao';

	protected $fillable = ['id_evento', 'id_inscrito', 'codigo_inscricao', 'status'];

	public static function getInscritos($id_evento) {
		$get = self::select(
			'id',
			'id_evento',
			'id_inscrito',
			DB::raw('(SELECT evento FROM tb_evento WHERE id = id_evento) AS evento'),
			DB::raw('(SELECT nome FROM tb_inscrito WHERE id = id_inscrito) AS inscrito'),
			DB::raw('(SELECT id_cidade FROM tb_inscrito WHERE id = id_inscrito) AS cidade'),
			DB::raw('(SELECT id_uf FROM tb_inscrito WHERE id = id_inscrito) AS uf'),
			DB::raw('(SELECT REGEXP_REPLACE(cpf, "[^\\x20-\\x7E]", "") AS cpf FROM tb_inscrito WHERE id = id_inscrito) AS cpf'),
			DB::raw('(SELECT REGEXP_REPLACE(rg, "[^\\x20-\\x7E]", "") AS rg FROM tb_inscrito WHERE id = id_inscrito) AS rg'),
			DB::raw('(SELECT REGEXP_REPLACE(telefone, "[^\\x20-\\x7E]", "") AS telefone FROM tb_inscrito WHERE id = id_inscrito) AS telefone'),
			DB::raw('(SELECT REGEXP_REPLACE(email, "[^\\x20-\\x7E]", "") AS email FROM tb_inscrito WHERE id = id_inscrito) AS email'),
			DB::raw('(DATE_FORMAT(created_at, "%d/%m/%Y %H:%i:%s")) AS data_inscricao'),
			'status',
			DB::raw('(SELECT COUNT(id) FROM tb_inscricao_boleto WHERE id_inscricao = id) AS pago')
		)
			->where('id_evento', $id_evento)->get();

		return $get;

	}
}
