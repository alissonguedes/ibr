<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InscricoesRequest extends FormRequest
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
		return [
			'cpf'      => 'required|regex:/^(\d){11}$/',
			'rg'       => 'required|regex:/^(\d){5,11}$/',
			'nome'     => ['required'],
			'email'    => ['required'],
			'telefone' => ['required', 'regex:/^(\d{11})$/'],
			'uf'       => ['required'],
			'cidade'   => ['required'],
		];
	}

	/**
	 * Get the messages rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function messages(): array
	{
		return [
			'cpf'      => ['required' => 'Campo obrigatório', 'regex' => 'Apenas números.'],
			'rg'       => ['required' => 'Campo obrigatório', 'regex' => 'Apenas números.'],
			'nome'     => ['required' => 'Campo obrigatório'],
			'email'    => ['required' => 'Campo obrigatório'],
			'telefone' => ['required' => 'Campo obrigatório', 'regex' => 'Campo Inválido. Apenas número (11 dígitos)'],
			'uf'       => ['required' => 'Campo obrigatório'],
			'cidade'   => ['required' => 'Campo obrigatório'],
		];
	}

}
