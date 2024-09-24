<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MinisterioModel extends PostModel
{

	use HasFactory;

	protected $table = 'tb_post';

	public function getAllMinisterios()
	{
		return $this->select(
			$this->columns
		)
			->where('categoria', 'ministerio')
			->get();
	}

	public function getMinisterio($data)
	{
		return $this->getOrWhere(['titulo_slug', $data])
			->first();
	}

}
