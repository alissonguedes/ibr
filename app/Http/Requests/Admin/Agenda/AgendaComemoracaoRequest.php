<?php

namespace App\Http\Requests\Admin\Agenda;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgendaComemoracaoRequest extends FormRequest
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

		$data = [
			'titulo'      => 'required',
			'hora_inicio' => 'required',
			'hora_fim'    => 'required',
		];

		// if (!isset($_POST['horario'])) {

		// $data['horario'] = ['required'];

		// }

		return $data;
	}

	public function messages(): array
	{
		return [
			'clinica' => [
				'required' => 'Você deve informar a qual clínica onde o médico atenderá esta agenda',
			],
			'horario' => [
				'required' => 'Você deve informar ao menos um horário disponível.',
			],
		];
	}
}
