<?php

$production = env('SICREDI_ENVIRONMENT') !== 'sandbox';

return [
	'api_key'       => $production ? env('SICREDI_API_KEY', '') : env('SICREDI_SB_API_KEY', ''),
	'cooperative'   => $production ? env('SICREDI_COOPERATIVE', '') : env('SICREDI_SB_COOPERATIVE', ''),
	'beneficiary'   => $production ? env('SICREDI_BENEFICIARY', '') : env('SICREDI_SB_BENEFICIARY', ''),
	'conta'         => $production ? env('SICREDI_CONTA', '') : env('SICREDI_SB_CONTA', ''),
	'post_number'   => $production ? env('SICREDI_POST', '') : env('SICREDI_SB_POST', ''),
	'client_id'     => $production ? env('SICREDI_CLIENT_ID', 'CLIENT_ID') : env('SICREDI_SB_CLIENT_ID', ''),
	'client_secret' => $production ? env('SICREDI_CLIENT_SECRET', 'CLIENT_SECRET') : env('SICREDI_SB_CLIENT_SECRET', ''),
	'username'      => $production ? env('SICREDI_USERNAME', 'USERNAME') : env('SICREDI_SB_USERNAME', ''),
	'password'      => $production ? env('SICREDI_PASSWORD', 'PASSWORD') : env('SICREDI_SB_PASSWORD', ''),
	'environment'   => ! $production,
];