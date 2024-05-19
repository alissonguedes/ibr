<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

// define('CHUNK_SIZE', 500 * 1024);
define('CHUNK_SIZE', 128 * 500);

class BannerModel extends Model {

	use HasFactory;

	protected $table = 'tb_banner';

	protected $fillable = [
		'id_banner',
		'id_chunk',
		'filedata',
		'titulo',
		'titulo_slug',
		'descricao',
		'imagem',
		'imgname',
		'imgtype',
		'imgsize',
		'autor',
		'ordem',
		'tags',
		'hits',
		'url',
		'publicar_ini',
		'publicar_fim',
		'created_at',
		'updated_at',
		'status',
	];

	public function __construct() {

		$this->connection = env('DB_SITE_CONNECTION');

	}

	public function getInfoFromFile(int $id_banner) {

		return $this->select(
			'imgname',
			'imgsize',
			'imgtype'
		)
			->from('tb_banner')->where('id', $id_banner)
			->get()->first();
	}

	public function getFile($id_banner) {

		return $this->select('filedata')
			->from('tb_banner_chunk')
			->where('id_banner', $id_banner)
			->get();

	}

	public function getWhere($data = null, $where = null) {

		$where = is_array($data) ? $data : [$data => $where];

		return $this->getColumns()->where($where)->first();

	}

	public function insert_or_update($request) {

		$columns = [];
		$data    = request()->all();
		$imagem  = $request->file('imagem');

		$columns['titulo']       = $data['titulo'];
		$columns['titulo_slug']  = replace($data['titulo']);
		$columns['descricao']    = $data['descricao'] ?? null;
		$columns['autor']        = Auth::id();
		$columns['ordem']        = $data['ordem'] ?? 0;
		$columns['tags']         = $data['tags'] ?? null;
		$columns['publicar_ini'] = $data['publicar_ini'] ?? null;
		$columns['publicar_fim'] = $data['publicar_fim'] ?? null;
		$img                     = $this->addAttachments($imagem);
		$where                   = !isset($data['id']) ? ['titulo' => $request->titulo] : ['id' => $data['id']];

		if (!empty($img)) {
			$columns['imgname'] = $img['name'];
			$columns['imgsize'] = $img['size'];
			$columns['imgtype'] = $img['type'];
		}

		$id_banner = BannerModel::updateOrCreate($where, $columns);

		if (!empty($img)) {
			$this->write_file_chunk($id_banner->id, $imagem);
		}

	}

	private function write_file_chunk($file_id, $file, $chunk = CHUNK_SIZE) {

		$this->from('tb_banner_chunk')->where('id_banner', $file_id)->delete();

		// dd($chunk);
		$offset    = 0;
		$file_name = $file->getClientOriginalName();
		$file_type = $file->getClientMimeType();
		$file_ext  = $file->getClientOriginalExtension();
		$file_size = $file->getSize();
		$file_tmp  = $file->getPathName();
		$fp        = fopen($file, 'rb');
		$content   = fread($fp, $file_size);

		fclose($fp);

		$_chunk = 0;

		while ($block = substr($content, $offset, $chunk)) {

			$columns = [
				'id_banner' => $file_id,
				'id_chunck' => $_chunk++,
				'filedata'  => $block,
			];

			$this->from('tb_banner_chunk')->insert($columns);

			$offset += strlen($block);

		}

		return $_chunk;

	}

	private function _getKeyAndHash($data = false, $file = false) {

		if ($file) {
			$sha1 = base64_encode(sha1_file($data, true));
			$md5  = base64_encode(md5_file($data, true));
		} else {
			$sha1 = base64_encode(sha1($data, true));
			$md5  = base64_encode(md5($data, true));
		}

		$prefix = base64_encode(sha1(microtime(), true));
		$key    = str_replace(
			array('=', '+', '/'),
			array('', '-', '_'),
			substr($prefix, 0, 5) . $sha1
		);

		$hash = str_replace(
			array('=', '+', '/'),
			array('', '-', ' '),
			substr($sha1, 0, 16) . substr($md5, 0, 16)
		);

		return array($key, $hash);

	}

	private function addAttachments($files, $inline = false, $lang = false) {

		if (empty($files)) {
			return [];
		}

		$file_name = $files->getClientOriginalName();
		$file_type = $files->getClientMimeType();
		$file_ext  = $files->getClientOriginalExtension();
		$file_size = $files->getSize();
		$file_tmp  = $files->getPathName();

		list($key, $sig) = $this->_getKeyAndHash($file_tmp, true);

		return [
			'name' => $file_name,
			'type' => $file_type,
			'ext'  => $file_ext,
			'size' => $file_size,
			'tmp'  => $file_tmp,
		];

	}

	public function forge($id_banner) {

		$this->from('tb_banner_chunk')->where('id_banner', $id_banner)->delete();
		$this->from('tb_banner')->where('id', $id_banner)->delete();

		return redirect()->route('admin.home.banners.index')->with(['message' => 'Banner removido com sucesso!']);

	}

}
