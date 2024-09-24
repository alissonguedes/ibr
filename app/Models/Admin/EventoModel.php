<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/**
 * A classe extende de PostModel, pois opera na tabela `tb_evento`
 */
class EventoModel extends Model
{

	use HasFactory;

	protected $table = 'tb_evento';

	protected $fillable = [
		'id_categoria',
		'tipo',
		'autor',
		'evento',
		'evento_slug',
		'descricao',
		'image',
		'video',
		'local_evento',
		'endereco',
		'data_ini',
		'data_fim',
		'dia_inteiro',
		'data_inscricao_ini',
		'data_inscricao_fim',
		'inscricao_encerrada',
		'observacao',
		'recorrencia',
		'recorrencia_periodo',
		'recorrencia_limite',
		'cor',
		'tags',
		'url',
		'hits',
		'ordem',
		'publish_up',
		'publish_down',
		'vagas',
		'gratuito',
		'valor',
		'id_file',
		'id_chunk',
		'filedata',
		'key',
		'signature',
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

	public function getAllEventos()
	{
		return $this->where('tipo', 'E')->get();
		// $container = 'eventos';
		// return $this->where(['tipo' => 'post'])->whereIn('id_parent', function ($query) use ($container) {
		// 	$query->select('id')->from('tb_evento')->where('titulo_slug', $container);
		// })->get();
	}

	public function getEvento($id)
	{

		return $this->where('id', $id)->get()->first();

	}

	public function getEventoByTitulo($titulo)
	{
		return $this->where('evento_slug', $titulo)->get()->first();
	}

	public function search($search, $both = true, $categoria = 'evento', $tipo = 'post')
	{

		// return $this->select($this->columns)->where('categoria', $categoria)
		// 	->whereAny([
		// 		'id',
		// 		'titulo',
		// 		'subtitulo',
		// 		'conteudo',
		// 	], 'like', ($both ? '%' : null) . $search . '%')
		// 	->whereNotNull('id_parent')
		// 	->get();

	}

	public function getAllActivePosts($categoria, $limit = 50, $options = [])
	{

		$options['next'] = null;
		$next            = $options['next'];

		$hoje = date('Y-m-d H:i:s');

		$get = self::select(
			'id',
			'id_categoria',
			DB::raw('(SELECT titulo FROM tb_evento_categoria WHERE id = id_categoria) as categoria'),
			DB::raw('(SELECT descricao_slug FROM tb_evento_categoria WHERE id = id_categoria) as descricao_slug'),
			'evento',
			'evento_slug',
			'descricao',
			'local_evento',
			'endereco',
			'data_ini AS data_evento',
			DB::raw('DATE_FORMAT(data_ini,"%d/%m/%Y %H:%i") as data_ini'),
			DB::raw('DATE_FORMAT(data_fim,"%d/%m/%Y %H:%i") as data_fim'),
			DB::raw('DATE_FORMAT(data_inscricao_ini,"%d/%m/%Y %H:%i") as data_inscricao_ini'),
			DB::raw('DATE_FORMAT(data_inscricao_fim,"%d/%m/%Y %H:%i") as data_inscricao_fim'),
			'observacao'
		);

		if (explode('/', Route::getCurrentRoute()->uri())[0] != 'admin') {
			// $get->where([
			// ['data_inscricao_ini', '<=', $hoje],
			// ['data_inscricao_fim', '>=', $hoje],
			// ]);
			$get->where('data_ini', '>=', $hoje);
		}

		$get->where('tipo', 'E');
		$get->where('status', '1')->limit($limit);

		if ($next === 'next') {
			$get->where('data_ini', '>=', $hoje);
		} else if ($next === 'prev') {
			$get->where('data_ini', '<=', $hoje);
		}

		return $get->get();

	}

	public function insert_or_update($request)
	{

		$columns = [];
		$data    = request()->all();

		$tipo = $this->select('titulo', 'titulo_slug')
			->from('tb_categoria')
			->whereAny(
				[
					'titulo',
					'titulo_slug',
				], '=', $data['tipo']
			)
			->get()->first();

		if (!isset($tipo)) {
			CategoriaModel::insert([
				'titulo'      => $data['tipo'],
				'titulo_slug' => replace($data['tipo'], '-'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
			]);
		}

		$columns['tipo']         = $data['tipo'] ?? 'E';
		$columns['id_categoria'] = 1;
		$columns['autor']        = Auth::id();
		$columns['evento']       = $data['titulo'];
		$columns['evento_slug']  = $data['titulo_slug'] ?? replace($data['titulo'], '-');
		$columns['descricao']    = $data['descricao'] ?? null;
		$data_evento             = $data['data'];
		$data_evento             = explode(' - ', $data_evento);
		$data_ini                = date('Y-m-d 00:00:00', strtotime(replace($data_evento[0], '/', '-')));
		$data_fim                = date('Y-m-d 23:59:59', strtotime(replace($data_evento[1], '/', '-')));
		$columns['data_ini']     = $data_ini;
		$columns['data_fim']     = $data_fim;
		$columns['dia_inteiro']  = $data['dia_inteiro'] ?? '0';
		$columns['local_evento'] = $data['local'] ?? null;
		$columns['endereco']     = $data['endereco'] ?? null;
		$columns['image']        = $data['image'] ?? null;
		$columns['video']        = $data['video'] ?? null;
		// $columns['tags']         = $data['tags'] ?? null;
		$data_inscricao                 = $data['data_inscricao'];
		$data_inscricao                 = explode(' - ', $data_inscricao);
		$data_inscricao_ini             = date('Y-m-d 00:00:00', strtotime(replace($data_inscricao[0], '/', '-')));
		$data_inscricao_fim             = date('Y-m-d 23:59:59', strtotime(replace($data_inscricao[1], '/', '-')));
		$columns['data_inscricao_ini']  = $data_inscricao_ini;
		$columns['data_inscricao_fim']  = $data_inscricao_fim;
		$columns['data_inscricao_ini']  = $data_inscricao_ini;
		$columns['data_inscricao_fim']  = $data_inscricao_fim;
		$columns['inscricao_encerrada'] = $data['inscricao_encerrada'] ?? '0';
		$columns['publish_up']          = $data['publish_up'] ?? null;
		$columns['publish_down']        = $data['publish_down'] ?? null;
		$columns['status']              = $data['status'] ?? '0';
		$imagem                         = $request->file('imagem');
		$where                          = !isset($data['id']) ? [
			'id_categoria' => 1,
			'evento_slug'  => $columns['evento_slug'],
		] : ['id' => $data['id']];

		$id_banner = EventoModel::updateOrCreate($where, $columns);

		FileModel::addAttachments($imagem, $id_banner->id);

		return true;

	}

	public static function remove($id, $categoria = 'post')
	{

		FileModel::remove($id, $categoria);
		self::where('id', $id)->delete();

		return true;

	}

}
