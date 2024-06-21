
		<table>
			<caption>Inscritos</caption>
			<thead>
				<tr>
					<th
						style="background-color: #333333; color: #ffffff; text-align: center; vertical-align: middle; width: 130px; height: 30px; border-bottom: 1px solid #ff0000;">
						Membro </th>
					<th
						style="background-color: #333333; color: #ffffff; text-align: center; vertical-align: middle; width: 130px; height: 30px; border-bottom: 1px solid #ff0000;">
						CPF </th>
					<th
						style="background-color: #333333; color: #ffffff; text-align: center; vertical-align: middle; width: 130px; height: 30px; border-bottom: 1px solid #ff0000;">
						Telefone/Celular </th>
					<th
						style="background-color: #333333; color: #ffffff; text-align: center; vertical-align: middle; width: 130px; height: 30px; border-bottom: 1px solid #ff0000;">
						E-mail </th>
					<th
						style="background-color: #333333; color: #ffffff; text-align: center; vertical-align: middle; width: 130px; height: 30px; border-bottom: 1px solid #ff0000;">
						Função </th>
					<th
						style="background-color: #333333; color: #ffffff; text-align: center; vertical-align: middle; width: 130px; height: 30px; border-bottom: 1px solid #ff0000;">
						Igreja </th>
					<th
						style="background-color: #333333; color: #ffffff; text-align: center; vertical-align: middle; width: 130px; height: 30px; border-bottom: 1px solid #ff0000;">
						Cidade </th>
					<th
						style="background-color: #333333; color: #ffffff; text-align: center; vertical-align: middle; width: 130px; height: 30px; border-bottom: 1px solid #ff0000;">
						UF </th>
					<th
						style="background-color: #333333; color: #ffffff; text-align: center; vertical-align: middle; width: 130px; height: 30px; border-bottom: 1px solid #ff0000;">
						Tipo de Transporte </th>
					<th
						style="background-color: #333333; color: #ffffff; text-align: center; vertical-align: middle; width: 130px; height: 30px; border-bottom: 1px solid #ff0000;">
						Dia da viagem </th>
				</tr>
			</thead>
			<tbody>

				@foreach ($inscritos as $inscrito)
					@php
						$cidade = App\Models\PaisModel::select('cidade')->from('tb_cidade')->where('id', $inscrito->cidade)->first();
						$estado = App\Models\PaisModel::select('estado')->from('tb_estado')->where('id', $inscrito->uf)->first();
						$funcao = App\Models\Ebd\FuncaoModel::select('descricao')->where('id', $inscrito->funcao)->first();
						$igreja = App\Models\Ebd\IgrejaModel::select('nome')->where('id', $inscrito->igreja)->first();
					@endphp
					<tr>
						<td style="text-transform: uppercase;">{{ $inscrito->membro }}</td>
						<td style="text-transform: uppercase;">{{ format($inscrito->cpf, 'cpf') }}</td>
						<td style="text-transform: uppercase;">{{ format($inscrito->celular, 'celular') }}</td>
						<td style="text-transform: lowercase;"><a href="mailto:{{ $inscrito->email }}">{{ $inscrito->email }}</a></td>
						<td style="text-transform: uppercase;">{{ $funcao->descricao }}</td>
						<td style="text-transform: uppercase;">{{ $igreja->nome }}</td>
						<td style="text-transform: uppercase;">{{ $cidade->cidade }}</td>
						<td style="text-transform: uppercase;">{{ $estado->estado }}</td>
						<td style="text-transform: uppercase;">{{ $inscrito->tipo_transporte == 'onibus' ? 'Ônibus' : $inscrito->tipo_transporte }}</td>
						<td style="text-transform: uppercase;">{{ $inscrito->data_viagem }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
