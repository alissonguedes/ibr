<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Illuminate\Support\Facades\DB;

class ConfigModel extends Model
{

	use HasFactory;

	protected $table    = 'tb_config';
	protected $fillable = ['config', 'value'];

	public function __construct()
	{

		$this->connection = env('DB_SITE_CONNECTION');

	}

	public function getAllConf()
	{

		$config  = [];
		$configs = $this->select('config', 'value')->get();

		foreach ($configs as $conf) {
			$config['site.' . $conf->config] = $conf->value;
		}

		return $config;

	}

}
