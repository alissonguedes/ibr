<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="ie=edge" http-equiv="X-UA-Compatible">
		<title>Document</title>
	</head>

	<body>

		<table style="font-family: sans-serif; font-size: 12px; border-collapse: collapse" border="1">
			<thead>
				<tr style="height: 3rem">
					<th style="padding-left: 10px; vertical-align: middle;" align="left" width="150">
						<img src="{{ asset('assets/img/sicredi-logo.png') }}" alt="" width="90">
					</th>
					@php
						$banco = substr($boleto->getPaymentInformation()->getBarCode(), 0, 4);
						$banco = preg_replace('/(\d{3})(\d)/', '$1-$2', $banco);
					@endphp
					<th style="vertical-align: middle; font-size: 16px;">{{ $banco }}</th>
					<th style="font-size: 16px; padding-right: 10px; vertical-align: middle;" align="right" colspan="4">{{ preg_replace('/(\d{5})(\d{5})(\d{5})(\d{6})(\d{5})(\d{6})(\d)/', '$1.$2 $3.$4 $5.$6 $7 $8', $boleto->getPaymentInformation()->getBarCode()) }}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" colspan="5">
						<small>Local de pagamento</small>
						<br>
						<span style="font-weight: bold; text-transform: uppercase;">Pagável em qualquer agência bancária</span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" bgcolor="#ccc">
						<small>Vencimento</small><br>
						@php
							$dueDate = $boleto->getDueDate();
						@endphp
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ $dueDate->format('d/m/Y') }}</span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" colspan="5">
						<small>Beneficiário</small>
						<br>
						<span style="font-weight: bold; text-transform: uppercase;">{{ $boleto->getBeneficiary()->getName() }} - CPF: {{ $boleto->getBeneficiary()->getDocument() }} </span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>Agência/Código Beneficiário</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ $dueDate->format('d/m/Y') }}</span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Data do Documento</small>
						<br>
						<span style="font-weight: bold; text-transform: uppercase;">{{ date('d/m/Y') }} </span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Número do Documento</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ $boleto->getPaymentInformation()->getOurNumber() }}</span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Espécie Documento</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ $boleto->getPaymentInformation()->getOurNumber() }}</span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="80px">
						<small>Aceite</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ 'Não' }}</span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Data de Processamento</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ date('d/m/Y') }}</span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200" bgcolor="#ccc">
						<small>Nosso Número</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ $boleto->getPaymentInformation()->getOurNumber() }}</span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Uso do banco</small>
						<br>
						<span style="font-weight: bold; text-transform: uppercase;">{{ date('d/m/Y') }} </span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Carteira</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ $boleto->getPaymentInformation()->getOurNumber() }}</span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Espécie</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ 'REAL' }}</span>
					</td>
					<td style="padding: 3px; vertical-align: top" width="80px">
						<small>Quantidade</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"></span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Valor</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"></span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>(=) Valor do documento</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ number_format($boleto->getAmount(), 2, ',', '.') }}</span>
					</td>
				</tr>

				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px" colspan="3" rowspan="5">
						<small>Instruções (Todas as informações deste bloqueto são de exclusiva responsabilidade do beneficiário)</small>
						<br>
						<span style="font-weight: bold; text-transform: uppercase;"> </span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px" colspan="2" rowspan="5">
						<small>Pagamento instantâneo com o QR Code</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"> </span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>(-) Desconto / Abatimento</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"> </span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>(-) Outras deduções</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"> </span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>(+) Juros / Multa</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"> </span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>(+) Outros acréscimos</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"> </span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>(=) Valor cobrado</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"> </span>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6"></td>
				</tr>
				<tr>
					<td style="border-color: #fff #fff #999 #fff; padding: 3px; vertical-align: top; height: 60px;" colspan="6">
						<small>Pagador:</small>
						<span style="text-align: left; margin-left: 50px; display: block; font-weight: bold; text-transform: uppercase;">{{ $boleto->getPayee()->getName() }} - {{ $boleto->getPayee()->getDocument() }}</span>
					</td>
				</tr>
				<tr>
					<td style="border-color: #fff #fff #999 #fff; padding: 3px; vertical-align: top; height: 26px; border-top-color: #fff;" colspan="5">
						<small>Sacador / Avalista:</small>
						<span style="text-align: left; margin-left: 50px; display: block; font-weight: bold; text-transform: uppercase;">{{ $boleto->getBeneficiary()->getName() }} - {{ $boleto->getBeneficiary()->getDocument() }}</span>
					</td>
					{{-- <td style="border-color: #fff; padding: 3px; vertical-align: top; height: 26px;" colspan="2">
						<small>Autenticação Mecânica</small>
					</td> --}}
					<td style="border-color: #fff #fff #999 #fff; padding: 3px; vertical-align: top; height: 26px;">
						<small>Código de baixa:</small>
					</td>
				</tr>
				<tr></tr>
			</tfoot>
		</table>

		<table style="font-family: sans-serif; font-size: 12px; border-collapse: collapse" border="1">
			{{-- <thead>
				<tr style="height: 3rem">
					<th style="padding-left: 10px; vertical-align: middle;" align="left" width="150">
						<img src="{{ asset('assets/img/sicredi-logo.png') }}" alt="" width="90">
					</th>
					<th style="vertical-align: middle">{{ substr($boleto->getPaymentInformation()->getBarCode(), 0, 4) }}</th>
					<th style="font-size: 16px; padding-right: 10px; vertical-align: middle;" align="right" colspan="4">{{ preg_replace('/(\d{5})(\d{5})(\d{5})(\d{6})(\d{5})(\d{6})(\d)/', '$1.$2 $3.$4 $5.$6 $7 $8', $boleto->getPaymentInformation()->getBarCode()) }}</th>
				</tr>
			</thead> --}}
			<thead>
				<tr style="height: 3rem">
					<th style="padding-left: 10px; vertical-align: middle;" align="left" width="150">
						<img src="{{ asset('assets/img/sicredi-logo.png') }}" alt="" width="90">
					</th>
					@php
						$banco = substr($boleto->getPaymentInformation()->getBarCode(), 0, 4);
						$banco = preg_replace('/(\d{3})(\d)/', '$1-$2', $banco);
					@endphp
					<th style="vertical-align: middle; font-size: 16px;">{{ $banco }}</th>
					<th style="font-size: 16px; padding-right: 10px; vertical-align: middle;" align="right" colspan="4">{{ preg_replace('/(\d{5})(\d{5})(\d{5})(\d{6})(\d{5})(\d{6})(\d)/', '$1.$2 $3.$4 $5.$6 $7 $8', $boleto->getPaymentInformation()->getBarCode()) }}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" colspan="5">
						<small>Local de pagamento</small>
						<br>
						<span style="font-weight: bold; text-transform: uppercase;">Pagável em qualquer agência bancária</span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" bgcolor="#ccc">
						<small>Vencimento</small><br>
						@php
							$dueDate = $boleto->getDueDate();
						@endphp
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ $dueDate->format('d/m/Y') }}</span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" colspan="5">
						<small>Beneficiário</small>
						<br>
						<span style="font-weight: bold; text-transform: uppercase;">{{ $boleto->getBeneficiary()->getName() }} - CPF: {{ $boleto->getBeneficiary()->getDocument() }} </span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>Agência/Código Beneficiário</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ $dueDate->format('d/m/Y') }}</span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Data do Documento</small>
						<br>
						<span style="font-weight: bold; text-transform: uppercase;">{{ date('d/m/Y') }} </span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Número do Documento</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ $boleto->getPaymentInformation()->getOurNumber() }}</span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Espécie Documento</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ $boleto->getPaymentInformation()->getOurNumber() }}</span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="80px">
						<small>Aceite</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ 'Não' }}</span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Data de Processamento</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ date('d/m/Y') }}</span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200" bgcolor="#ccc">
						<small>Nosso Número</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ $boleto->getPaymentInformation()->getOurNumber() }}</span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Uso do banco</small>
						<br>
						<span style="font-weight: bold; text-transform: uppercase;">{{ date('d/m/Y') }} </span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Carteira</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ $boleto->getPaymentInformation()->getOurNumber() }}</span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Espécie</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ 'REAL' }}</span>
					</td>
					<td style="padding: 3px; vertical-align: top" width="80px">
						<small>Quantidade</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"></span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px">
						<small>Valor</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"></span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>(=) Valor do documento</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;">{{ number_format($boleto->getAmount(), 2, ',', '.') }}</span>
					</td>
				</tr>

				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px" colspan="3" rowspan="5">
						<small>Instruções (Todas as informações deste bloqueto são de exclusiva responsabilidade do beneficiário)</small>
						<br>
						<span style="font-weight: bold; text-transform: uppercase;"> </span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="150px" colspan="2" rowspan="5">
						<small>Pagamento instantâneo com o QR Code</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"> </span>
					</td>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>(-) Desconto / Abatimento</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"> </span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>(-) Outras deduções</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"> </span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>(+) Juros / Multa</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"> </span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>(+) Outros acréscimos</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"> </span>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px; vertical-align: top; height: 26px;" width="200">
						<small>(=) Valor cobrado</small><br>
						<span style="text-align: right; display: block; font-weight: bold; text-transform: uppercase;"> </span>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6"></td>
				</tr>
				<tr>
					<td style="border-color: #fff #fff #999 #fff; padding: 3px; vertical-align: top; height: 60px;" colspan="6">
						<small>Pagador:</small>
						<span style="text-align: left; margin-left: 50px; display: block; font-weight: bold; text-transform: uppercase;">{{ $boleto->getPayee()->getName() }} - {{ $boleto->getPayee()->getDocument() }}</span>
					</td>
				</tr>
				<tr>
					<td style="border-color: #fff #fff #999 #fff; padding: 3px; vertical-align: top; height: 26px;" colspan="3">
						<small>Sacador / Avalista:</small>
						<span style="text-align: left; margin-left: 50px; display: block; font-weight: bold; text-transform: uppercase;">{{ $boleto->getBeneficiary()->getName() }} - {{ $boleto->getBeneficiary()->getDocument() }}</span>
					</td>
					<td style="border-color: #fff #fff #999 #fff; padding: 3px; vertical-align: top; height: 26px;" colspan="2">
						<small>Autenticação Mecânica</small>
					</td>
					<td style="border-right-color: #fff; padding: 3px; vertical-align: top; height: 26px;">
						<small>Código de baixa:</small>
					</td>
				</tr>
				<tr>
					<td colspan="6"></td>
				</tr>
				<tr>
					<td style="border-color: #fff" colspan="6">
						<br>
						@php
							$barcode = 'assets/img/boletos/barcode_' . $boleto->getPaymentInformation()->getBarCode() . '.png';
						@endphp
						<img src="{{ asset($barcode) }}" alt="{{ $boleto->getPaymentInformation()->getBarCode() }}">
					</td>
				</tr>
			</tfoot>
		</table>

	</body>

</html>
