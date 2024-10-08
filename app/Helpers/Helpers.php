<?php

use App\Models\Model;

/**
 * Remove caratecres especiais
 * Converte todos os caracteres de um arquivo para caixa baixa
 * Remove espaçamentos.
 */
if (!function_exists('replace')) {

	function replace($string, $find = ' ', $replace = '-', $to_lower = true)
	{

		$args = func_get_args();

		if (count($args) < 4) {

			$string = $args[0];

			if (!is_string($args[0])) {
				$exception = 'O argumento [1] deve ser uma string e está recebendo um valor ' . gettype($args[0]);
			}

			if (count($args) === 2) {
				if (is_bool($args[1])) {
					$to_lower = $args[1];
				} else {
					$replace = $args[1] ?? trim($replace);
					$find    = null;
				}
			}

			if (count($args) === 3) {
				$find = null;
				if (is_bool($replace)) {
					$replace  = $args[1];
					$to_lower = $args[2];
				}
			}

			if (strlen($replace) > 1) {
				$exception = 'O argumento [2] deve conter apenas um carácter.';
			}

			if (is_bool($replace)) {
				$to_lower = $replace;
			}

			if (isset($exception)) {
				throw new Exception($exception);
			}

		}

		// echo preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})/', '***.$2.$3-**', '06942292451');

		$output = [];
		$a      = ['Á' => 'a', 'À' => 'a', 'Â' => 'a', 'Ä' => 'a', 'Ã' => 'a', 'Å' => 'a', 'á' => 'a', 'à' => 'a', 'â' => 'a', 'ä' => 'a', 'ã' => 'a', 'å' => 'a', 'a' => 'a', 'Ç' => 'c', 'ç' => 'c', 'Ð' => 'd', 'É' => 'e', 'È' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i', 'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i', 'Ñ' => 'n', 'ñ' => 'n', 'Ó' => 'o', 'Ò' => 'o', 'Ô' => 'o', 'Ö' => 'o', 'Õ' => 'o', 'ó' => 'o', 'ò' => 'o', 'ô' => 'o', 'ö' => 'o', 'õ' => 'o', 'ø' => 'o', 'œ' => 'o', 'Š' => 'o', 'Ú' => 'u', 'Ù' => 'u', 'Û' => 'u', 'Ü' => 'u', 'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'Ý' => 'y', 'Ÿ' => 'y', 'ý' => 'y', 'ÿ' => 'y', 'Ž' => 'z', 'ž' => 'z'];
		$string = strtr($string, $a);
		$regx   = isset($find) && !empty($find) ? $find : [' ', '.', '+', '@', '#', '!', '$', '%', '¨', '&', '*', '(', ')', '_', '-', '+', '=', ';', ':', ',', '\\', '|', '£', '¢', '¬', '/', '?', '°', '´', '`', '{', '}', '[', ']', 'ª', 'º', '~', '^', "\'", '"'];

		$tolowercase = $to_lower ? strtolower($string) : $string;
		$replacement = str_replace($regx, '|', trim($tolowercase));
		$explode     = explode('|', $replacement);

		// dd($find, $replace);
		if ($find === '' && !empty($replace)) {

			unset($regx[0]);
			$conv       = [];
			$new_string = str_replace($regx, '', $string);
			$new_string = explode(' ', $string);

			foreach ($new_string as $s) {

				$str = '';

				for ($i = 0; $i < strlen($s); $i++) {
					$s   = str_replace($s[$i], $replace, $s);
					$str = $s;
				}

				$conv[] = $str;

			}

			return implode(' ', $conv);

		}

		for ($i = 0; $i < count($explode); ++$i) {
			if (!empty($explode[$i])) {
				$output[] = trim($explode[$i]);
			}
		}

		return implode($replace, $output);

	}
}

if (!function_exists('lang')) {

	function lang($return_id = false)
	{

		$sigla = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : config('site.language');

		if (!$return_id) {
			return $sigla;
		}

		$model = new Model();
		$model->setConnection(env('DB_SYSTEM_CONNECTION'));

		$id = $model->select('id')
			->from('tb_sys_idioma')
			->where('sigla', $sigla)
			->get()
			->first();

		return $id->id ?? $sigla;

	}

}

if (!function_exists('getMenu')) {

	function getMenu($local, $id = null, $path = null)
	{

		$model = new Model();
		$model->setConnection(env('DB_SYSTEM_CONNECTION'));

		$menu_list = [];
		$modulo    = explode('/', request()->path());
		$path      = '/' . (is_string($path) ? $path : $modulo[0]);

		$modulo = $model->select('id')
			->from('tb_acl_modulo')
			->where('path', $path)
			->get()
			->first();

		if (isset($modulo)) {
			$idModulo = $modulo->id;
		}

		$menus = $model->select(
			'Menu.id',
			'Menu.status',
			DB::raw('(SELECT titulo FROM tb_acl_menu_descricao WHERE id_menu = Menu.id AND id_idioma = "' . lang(true) . '") AS titulo'),
			DB::raw('(SELECT descricao FROM tb_acl_menu_descricao WHERE id_menu = Menu.id AND id_idioma = "' . lang(true) . '") AS descricao'),
		)
			->from('tb_acl_menu AS Menu')
			->join('tb_acl_modulo_grupo_menu AS MG_Menu', 'MG_Menu.id_menu', 'Menu.id')
			->whereIn('MG_Menu.id_modulo_grupo', function ($query) use ($idModulo, $modulo, $path) {

				$query = $query->select('id')
					->from('tb_acl_modulo_grupo')
					->whereColumn('id_modulo_grupo', 'id')
					->where('id_modulo', $idModulo);

				// If Is Restrict Modulo

				// if ($moduloModel->getIsRestrictModulo($path)) {
				// if (session()->exists('userdata') && session()->exists('app_session')) {
				// 	$id_grupo = session()->get('userdata')[session()->get('app_session')]['id_grupo'];
				$query->where('id_grupo', 1);
				// }
				// }

			})
			->whereColumn('MG_Menu.id_menu', 'Menu.id')
			->where('Menu.status', '1')
			->where('MG_Menu.status', '1')
			->get();

		if ($menus->count() > 0) {

			foreach ($menus as $menu) {

				$items = $model->select(
					'Item.id',
					'Item.id_controller',
					'Item.id_parent',
					'Item.id_route',
					'Item.icon',
					'Item.divider',
					'Item.item_type',
					DB::raw('(SELECT titulo FROM tb_acl_menu_item_descricao WHERE id_item = Item.id AND id_idioma = "' . lang(true) . '") AS titulo'),
					DB::raw('(SELECT descricao FROM tb_acl_menu_item_descricao WHERE id_item = Item.id AND id_idioma = "' . lang(true) . '") AS descricao'),
				)
					->from('tb_acl_menu_item AS Item')
					->whereIn('Item.id', function ($query) use ($menu, $path, $idModulo, $model) {

						$query->select('I.id_item')
							->from('tb_acl_menu_item_menu AS I')
							->whereColumn('I.id_item', 'Item.id')
							->where('I.status', '1')
						// ->where('I.id_menu', $menu->id)
							->whereIn('I.id_menu', function ($query) use ($menu, $path, $idModulo, $model) {

								$query->select('id_menu')
									->from('tb_acl_modulo_grupo_menu AS G')
									->whereColumn('G.id_menu', 'I.id_menu')
									->where('G.id_menu', $menu->id)
									->where('id_modulo_grupo', function ($query) use ($menu, $path, $idModulo) {

										$query = $query->select('id')
											->from('tb_acl_modulo_grupo')
											->whereColumn('id', 'id_modulo_grupo')
											->where('id_modulo', $idModulo);

										// If Is Restrict Modulo
										// if ($moduloModel->getIsRestrictModulo($path)) {
										// if (Auth::user()) {
										// 	$id_grupo = Auth::user()->id_grupo;
										$query->where('id_grupo', 1);
										// }

										// if (session()->exists('userdata') && session()->exists('app_session')) {
										//     $id_grupo = session()->get('userdata')[session()->get('app_session')]['id_grupo'];
										//     $query->where('id_grupo', $id_grupo);
										// }
										// }
									});

							});

					})
					->where('id_parent', $id)
					->where('status', '1')
					->orderBy('ordem', 'asc')
					->orderBy('descricao', 'asc')
					->get();

				if ($items->count() > 0) {

					foreach ($items as $item) {

						$route = $model->select('name')
							->from('tb_acl_modulo_routes')
							->where('id_controller', $item->id_controller)
							->where('status', '1')
							->where('type', 'any')
							->where(function ($query) {
								$query->where('id_parent', null)
									->orWhere('id_parent', '0');
							});

						if ($item->id_route) {
							$route->where('id', $item->id_route);
						}

						$route = $route->first();

						$submenus = $model->from('tb_acl_menu_item')
							->where('id_parent', $item->id)
							->where('status', '1')
							->whereIn('id', function ($query) use ($menu) {

								$query->select('id_item')
									->from('tb_acl_menu_item_menu')
									->whereColumn('id_item', 'id')
									->where('id_menu', $menu->id)
									->where('status', '1');

							})->get();

						if (!is_null($item->item_type)) {
							$menu_list[$menu->id][] = [
								'id'        => $item->id,
								'id_parent' => $item->id_parent,
								'titulo'    => $item->item_type,
								'categoria' => true,
							];
						}

						$menu_list[$menu->id][$item->id] = [
							'id'            => $item->id,
							'id_parent'     => $item->id_parent,
							'id_controller' => $item->controller,
							'id_route'      => $item->id_route,
							'route'         => $route->name,
							'icon'          => $item->icon,
							'divider'       => $item->divider,
							'item_type'     => $item->item_type,
							'titulo'        => $item->titulo,
							'descricao'     => $item->descricao,
							'categoria'     => false,
							'children'      => [],
						];

						if ($submenus->count() > 0) {
							$menu_list[$menu->id][$item->id]['children'] = getMenu($local, $item->id);
						}

						// FUNCIONANDO...
						// FUNCIONANDO...
						// if (!is_null($item->item_type)) {
						// $menu_list['menus'][$item->id] = [
						// 	'id'       => $item->id,
						// 	'titulo'   => $item->item_type,
						// 	'category' => true,
						// 	'list'     => [],
						// ];
						// }

						// FUNCIONANDO...
						// $menu_list['menus'][$item->id]['list'][] = [
						// 	'id'        => $item->id,
						// 	'id_parent' => $item->id_parent,
						// 	'titulo'    => $item->titulo,
						// 	'route'     => $route->name,
						// 	'category'  => false,
						// ];

						// FUNCIONANDO...
						// if ($submenus->count() > 0) {
						// 	$menu_list['submenus'][$item->id] = getMenu($local, $item->id);
						// }

					}

				}
			}

		}

		return $menu_list;

	}

}

if (!function_exists('make_menu')) {

	function make_menu($local, $path = null, $id = null, $s = null)
	{

		if (!empty($attributes)) {
			foreach ($attributes as $ind => $val) {
				$params .= ' ' . $ind . '="' . $val . '"';
			}
		}

		$ul = [];

		$items = getMenu($local, $id, $path);

		$menus = [];

		return view('navigation', ['id_menu' => $id ?? 0, 'menus' => $items]);

	}

}

if (!function_exists('base_url')) {

	function base_url()
	{

		$path     = '/';
		$base_url = explode('/', request()->getRequestUri());

		foreach ($base_url as $ind => $base) {

			if ($base_url[$ind] == '') {
				$base_url[$ind] = '/';
			}

			$dir = app_path() . '/Http/Controllers/' . ucfirst(str_replace('/', '', $base_url[$ind]));
			if ($base_url[$ind] != '/' && is_dir($dir)) {
				$path = $base;
				break;
			}

		}

		return url($path) . '/';

	}
}

if (!function_exists('site_url')) {

	function site_url()
	{

		return url('/') . '/';

	}

}

if (!function_exists('post')) {

	function post($categoria, $limit = 1, $options = [])
	{

		$posts     = [];
		$view      = explode(':', $categoria);
		$categoria = $view[1];
		$model     = 'App\\Models\\Admin\\' . ucfirst(strtolower($categoria)) . 'Model';

		if (class_exists($model)) {

			$post = new $model();

		} else {

			$post = new App\Models\Admin\PostModel();

		}

		$posts = $post->getAllActivePosts($categoria, $limit, $options);

		if (!empty($post)) {
			$data['post'] = $posts;
			return view($view[0] . '.' . $categoria, $data);
		}

		return view($view[0] . '.' . $categoria);

	}

}

if (!function_exists('pastores')) {

	function pastores($section = null, $status = '1')
	{

		$pastores = '';

		$pastor   = new App\Models\Admin\PastorModel();
		$pastores = $pastor->getActivePastores($section);

		dd($pastores);

	}

}

if (!function_exists('slides')) {

	function slides($section = 'slideshow-container', $status = '1')
	{

		$slides  = '';
		$banner  = new App\Models\Admin\BannerModel();
		$banners = $banner->getActiveBanners($section);

		if ($banners->count() > 0) {

			$data['banners'] = $banners;
			return view('main.home.slides', $data);

		}

		return $slides;

	}

}

if (!function_exists('show_date')) {

	function show_date($date, $show_year = true, $show_month = true, $show_day = true, $format = 'd/m/Y')
	{

		$meses = [1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'];
		$date  = strtotime($date);
		$dia   = date('d', $date);
		$mes   = $meses[date('n', $date - 1)];
		$ano   = date('Y', $date);

		return $dia . ' de ' . $mes . ($show_year ? ' de ' . $ano : null);

	}

}
