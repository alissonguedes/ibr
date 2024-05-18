<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{

	use HasFactory;

	protected $table = 'tb_banner';

	public function __construct()
	{

		$this->connection = env('DB_SITE_CONNECTION');

	}

}
