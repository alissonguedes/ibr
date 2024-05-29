<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriaRequest extends FormRequest {
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
	public function rules($request = null): array {

		if (!empty($request)) {
			$request = $request->all();
		}

		$rules = [
			'titulo'    => 'required',
			'descricao' => 'max:255',
			// 'url'       => 'nullable|url',
		];

		return $rules;

	}
}
