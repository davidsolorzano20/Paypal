<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Payment Paypal
	|--------------------------------------------------------------------------
	|
	| Client ID
	|
	*/

	'client_id' => 'AR-v_kC8l9-z61xoVEjDHnOxQrQD4GYS4jj7FxkMJKVXrEhKQKKwWmjvLMi2lC0h4tA_jz4PdYv0CsSk',

	/*
	|--------------------------------------------------------------------------
	| Key
	|--------------------------------------------------------------------------
	| Secret Key
	|
	*/

	'secret' => 'EAJENBdEWqgoX0aL2r2i4UTG1Fo0z2r_XB9lwuWZJQyCLOoYQIEWca8BNr8OqcG8ZdLmXCzpcWwdpf5u',


	/*
	|--------------------------------------------------------------------------
	| Settings
	|--------------------------------------------------------------------------
	*/

	'settings' => [
		'mode' => 'sandbox',
		'http.ConnectionTimeOut' => 30,
		'log.LogEnabled' => true,
		'log.FileName' => storage_path() . '/logs/paypal.log',
		'log.LogLevel' => 'FINE'

	]
];
