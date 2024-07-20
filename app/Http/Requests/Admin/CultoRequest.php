<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CultoRequest extends FormRequest
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
	public function rules(): array
	{

		$rules = [
			'titulo' => [
				'required',
			],
			'url'    => 'required',
			'data'   => 'required',
			// 'subtitulo' => ['required'],
			// 'conteudo'  => ['required'],
		];

		if (!isset($this->id)) {
			$rules['imagem'] = [
				'required',
				'mimes:jpg,jpeg,png',
				'dimensions:1920,1080',
			];
		}

		return $rules;

	}
}
