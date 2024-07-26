<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\FileModel;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

	public function index(Request $request, User $user, $id = null): View
	{

		$get = $user;

		if (Auth::user()->nivel !== 'root') {
			$get = $user->where('nivel', '<>', 'root');
		}

		$data['usuarios'] = $get->where('id', '<>', Auth::id())->get();

		if ($request->id) {
			$data['row'] = $user->where('id', $request->id)->get()->first();
		}

		return view('admin.usuarios.index', $data);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id)
	{

		return $file->showFile($file_id, 'usuario');

	}

	/**
	 * Search categorias
	 */
	public function search(Request $request, User $user)
	{

		$get = $user;

		if (Auth::user()->nivel !== 'root') {
			$get = $user->where('nivel', '<>', 'root');
		}

		$data['usuarios'] = $get->whereAny(['name', 'email'], 'like', '%' . $request->search . '%')->get();

		return view('admin.usuarios.index', $data);

	}

	/**
	 * Display the registration view.
	 */
	public function create(): View
	{
		return view('auth.register');
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request): RedirectResponse
	{

		$fields = [
			'name'  => ['required', 'string', 'max:255'],
			'nivel' => ['required'],
			'email' => [
				'required',
				'string',
				'lowercase',
				'email',
				'max:255',
				Rule::unique('site.tb_usuario', 'email')->ignore($request->id, 'id'),
			],
		];

		// $2y$12$21GExedrlgi6KPNMw6VPwOOCwHrdSHYXt1cDj9v9ndMOZNkGJJj06

		if ($request->password == 'post') {
			$fields['password'] = ['required'];
		}

		if (!empty($request->password)) {
			$fields['password'] = ['confirmed', Rules\Password::defaults()];
		}

		$update_fields = [
			'nivel'  => $request->nivel,
			'name'   => $request->name,
			'email'  => $request->email,
			'status' => $request->status ?? '0',
		];

		if (!empty($request->password)) {
			$update_fields['password'] = Hash::make($request->password);
		}

		// $user = User::updateOrCreate(['email' => $request->email], $update_fields);

		$user = User::select('id')->where('email', $request->email)->get()->first();

		if (!isset($user)) {
			$fields['password'] = ['required'];
		}

		$request->validate($fields);

		$user = User::updateOrCreate(['email' => $request->email], $update_fields);
		// $request->categoria = 'usuario';

		FileModel::addAttachments($request->imagem, $user->id);

		event(new Registered($user));

		// Auth::login($user);

		return redirect(route('admin.usuarios.index', absolute: false));
	}

	public function destroy(Request $request)
	{

		if (User::where('id', $request->id)->delete()) {
			$message = 'Usuário removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('admin.usuarios.index')->with(['message' => $message]);

	}

}
