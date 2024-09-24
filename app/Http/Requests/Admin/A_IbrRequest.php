<?php

namespace App\Http\Requests\Admin;

use App\Rules\WordsCountRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class A_IbrRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array {

		$rules = [
			'titulo'   => [
				'required',
				// new WordsCountRule(6),
			],
			'conteudo' => ['required', new WordsCountRule(1000)],
			'url'      => 'nullable|url',
		];

		if (!isset($this->id)) {
			$rules['imagem'] = [
				// 'required',
				'mimes:jpg,jpeg,png',
				'dimensions:1920,1080',
			];
		}

		return $rules;

	}
}
