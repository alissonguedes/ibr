<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as MainModel;

class Model extends MainModel
{

	use HasFactory;

	public function getWhere($data = null, $where = null)
	{

		$where = is_array($data) ? $data : [$data => $where];

		return $this->getColumns()->where($where)->first();

	}

	public function getOrWhere(array $data)
	{

		$where = func_get_args();

		$get = $this->select($this->columns ?? '*');

		if (is_array($where)) {

			$get = $get->where(function ($query) use ($where) {
				for ($i = 0; $i < count($where); $i++) {
					$query->orWhere($where[$i][0], $where[$i][1]);
				}
			});

		}

		return $get;

	}

}
