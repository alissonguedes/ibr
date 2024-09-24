<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgendaRequest extends FormRequest
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
			'titulo'         => 'required',
			// 'url'            => 'requiredIf:imagem,null',
			'data'           => 'required',
			// 'hora'           => 'required',
			'local'          => 'required',
			'endereco'       => 'required',
			'data_inscricao' => 'required',
			// 'data_inscricao_fim' => 'required',
			// 'data_ini' => 'required',
			// 'data_fim' => 'required',
			// 'subtitulo' => ['required'],
			// 'conteudo'  => ['required'],
		];

		if (!isset($this->id)) {
			$rules['imagem'] = [
				'requiredIf:url,null',
				'mimes:jpg,jpeg,png',
				'dimensions:1920,1080',
			];
		}

		return $rules;

	}
}
