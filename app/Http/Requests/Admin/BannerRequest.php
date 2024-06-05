<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules($request = null): array
	{

		if (!empty($request)) {
			$request = $request->all();
		}

		$rules = [
			'tipo'      => 'required',
			'categoria' => 'required',
			'titulo'    => 'required',
			'descricao' => 'max:255',
			'url'       => 'nullable|url',
		];

		if (!isset($request['id']) && !isset($this->id)) {
			$rules['imagem'] = [
				'required',
				'mimes:jpg,png',
				'dimensions:1920,1080',
			];
		}

		return $rules;

	}
}
