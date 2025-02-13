<?php
namespace App\Models;

use App\Models\Admin\InscricaoModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SicrediAPI\Client as PixSicredi;

// use Barryvdh\DomPDF\Facade\Pdf;
use SicrediAPI\Domain\Boleto\Beneficiary;
use SicrediAPI\Domain\Boleto\Boleto;
use SicrediAPI\Domain\Boleto\Payee;

class BoletoModel extends Model {
	use HasFactory;

	private $sicredi;

	protected $table = 'tb_inscricao_boleto';

	protected $fillable = [
		'id_inscricao',
		// 'id_inscrito',
		'data_pagamento',
		'beneficiario',
		'pagador',
		'valor',
		'vencimento',
		'linha_digitavel',
		'codigo_barra',
		'qr_code',
		'nosso_numero',
		'transaction_id',
		'tipo',
		'especie',
		'liquidado',
		'informacoes',
		'mensagem',
		'carteira',
		'arquivo',
		'status',
	];

	public function __construct() {

		$this->sicredi = new PixSicredi(
			config('sicredi.api_key'),
			config('sicredi.cooperative'),
			config('sicredi.post_number'),
			config('sicredi.beneficiary'),
			new \GuzzleHttp\Client(),
			config('sicredi.environment')
		);

		$this->sicredi->authenticate(
			config('sicredi.username'),
			config('sicredi.password')
		);

		$this->setConnection('site');

	}

	public function emitirBoleto($dados) {

		$beneficiario = new Beneficiary($dados['beneficiary']['nome'], $dados['beneficiary']['cpf'], $dados['beneficiary']['tipo']);
		$pagador      = new Payee($dados['payee']['nome'], $dados['payee']['cpf'], $dados['payee']['tipo']);
		$valor        = $dados['valor'];

		$boleto = new Boleto(
			$beneficiario,
			$pagador,
			$valor,
			'DM',
			12345,
			'RECIBO',
			'999999',
			new \DateTime('2025-12-31'),
		);

		$boletoClient = $this->sicredi->boleto();
		$boleto       = $boletoClient->create($boleto);
		$this->gerarBarCode($boleto->getPaymentInformation()->getBarCode());

		return $boleto;
		return $boleto = $boletoClient->print();

		// $qrcode = new SimpleSoftwareIO\QrCode\Facades\QrCode();
		// $qr = QrCode::generate($b->getPaymentInformation()->getQrCode());

		// return view('admin.dashboard')->with('qrcode', $qr);

	}

	public function cadastraBoleto(Boleto $boleto, InscricaoModel $inscricao) {

		$beneficiario = json_encode([
			'tipo'     => $boleto->getBeneficiary()->getPersonKind(),
			'document' => $boleto->getBeneficiary()->getDocument(),
			'name'     => $boleto->getBeneficiary()->getName(),
			'code'     => $boleto->getBeneficiary()->getCode(),
			'address'  => $boleto->getBeneficiary()->getAddress(),
			'city'     => $boleto->getBeneficiary()->getCity(),
			// 'complement'   => $boleto->getBeneficiary()->getComplement(),
			// 'addressNumber' => $boleto->getBeneficiary()->getAddressNumber(),
			'state'    => $boleto->getBeneficiary()->getState(),
			'zipCode'  => $boleto->getBeneficiary()->getZipCode(),
			'phone'    => $boleto->getBeneficiary()->getPhone(),
			'email'    => $boleto->getBeneficiary()->getEmail(),
		]);

		$pagador = json_encode([
			'tipo'     => $boleto->getPayee()->getPersonKind(),
			'document' => $boleto->getPayee()->getDocument(),
			'name'     => $boleto->getPayee()->getName(),
			'code'     => $boleto->getPayee()->getCode(),
			'address'  => $boleto->getPayee()->getAddress(),
			'city'     => $boleto->getPayee()->getCity(),
			// 'complement'   => $boleto->getPayee()->getComplement(),
			// 'addressNumber' => $boleto->getPayee()->getAddressNumber(),
			'state'    => $boleto->getPayee()->getState(),
			'zipCode'  => $boleto->getPayee()->getZipCode(),
			'phone'    => $boleto->getPayee()->getPhone(),
			'email'    => $boleto->getPayee()->getEmail(),
		]);

		$dadosBoleto = [
			'id_inscricao'    => $inscricao->id,
			'data_pagamento'  => null,
			'beneficiario'    => $beneficiario,
			'pagador'         => $pagador,
			'valor'           => $boleto->getAmount(),
			'vencimento'      => $boleto->getDueDate()->format('Y-m-d'),
			'linha_digitavel' => $boleto->getPaymentInformation()->getNumericRepresentation(),
			'codigo_barra'    => $boleto->getPaymentInformation()->getBarCode(),
			'qr_code'         => $boleto->getPaymentInformation()->getQrCode(),
			'nosso_numero'    => $boleto->getPaymentInformation()->getOurNumber(),
			'transaction_id'  => $boleto->getPaymentInformation()->getTransactionId(),
			'tipo'            => $boleto->getDocumentType(),
			'especie'         => $boleto->getChargeKind(),
			'liquidado'       => $boleto->getLiquidation(),
			'informacoes'     => $boleto->getInformation(),
			'mensagem'        => $boleto->getMessages(),
			'carteira'        => $boleto->getWallet(),
			// 'desconto'        => $boleto->getDiscountConfiguration(),
			// 'interesse'       => $boleto->getInterestConfiguration(),
			'status'          => $boleto->getStatus() ?? 'pendente',
		];

		return $this->updateOrCreate(['nosso_numero' => $dadosBoleto['nosso_numero']], $dadosBoleto);

	}

	public function gerarBarCode($code) {

		// $barcode = \Barcode::generate($code->file_id);
		$barcode = \Barcode::generate($code);

		// return $barcode;
		// file_put_contents('barcode.png', )
		$caminho = 'assets/img/boletos/barcode_' . $code . '.png';
		return \Storage::put($caminho, $barcode);

		// return $barcode;
		// return '<img src="' . asset($caminho) . '" height="60px" width="200px">';

	}
}
