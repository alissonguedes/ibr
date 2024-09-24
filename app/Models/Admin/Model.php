<?php

namespace App\Models\Admin;

use App\Models\Model as MainModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Model extends MainModel
{

	use HasFactory;

	public function __construct()
	{
		$this->connection = env('DB_SITE_CONNECTION');
	}

}
