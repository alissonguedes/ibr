<?php

$basedir = file_exists('../public_html') ? 'public_html' : 'public';

return [

	/*
	|--------------------------------------------------------------------------
	| Default Filesystem Disk
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default filesystem disk that should be used
	| by the framework. The "local" disk, as well as a variety of cloud
	| based disks are available to your application. Just store away!
	|
	 */

	'default' => env('FILESYSTEM_DRIVER', 'local'),

	/*
	|--------------------------------------------------------------------------
	| Filesystem Disks
	|--------------------------------------------------------------------------
	|
	| Here you may configure as many filesystem "disks" as you wish, and you
	| may even configure multiple disks of the same driver. Defaults have
	| been setup for each driver as an example of the required options.
	|
	| Supported Drivers: "local", "ftp", "sftp", "s3"
	|
	 */

	'disks'   => [

		'local'  => [
			'driver' => 'local',
			// 'root'   => storage_path('app'),
			'root'   => storage_path('/'),
		],

		'public' => [
			'driver'     => 'local',
			// 'root'       => storage_path('public'),
			'root'       => storage_path('app/' . $basedir),
			'url'        => env('APP_URL') . '/storage',
			'visibility' => 'public',
		],

		's3'     => [
			'driver'                  => 's3',
			'key'                     => env('AWS_ACCESS_KEY_ID'),
			'secret'                  => env('AWS_SECRET_ACCESS_KEY'),
			'region'                  => env('AWS_DEFAULT_REGION'),
			'bucket'                  => env('AWS_BUCKET'),
			'url'                     => env('AWS_URL'),
			'endpoint'                => env('AWS_ENDPOINT'),
			'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Default Filesystem Disk
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default filesystem disk that should be used
	| by the framework. The "local" disk, as well as a variety of cloud
	| based disks are available to your application. Just store away!
	|
	 */

	'default' => env('FILESYSTEM_DRIVER', 'public'),

	/*
	|--------------------------------------------------------------------------
	| Filesystem Disks
	|--------------------------------------------------------------------------
	|
	| Here you may configure as many filesystem "disks" as you wish, and you
	| may even configure multiple disks of the same driver. Defaults have
	| been setup for each driver as an example of the required options.
	|
	| Supported Drivers: "local", "ftp", "sftp", "s3"
	|
	 */

	'disks'   => [

		'local'  => [
			'driver' => 'local',
			'root'   => storage_path('/'),
		],

		'public' => [
			'driver'     => 'local',
			// 'root'       => storage_path('app/' . $basedir),
			'root'       => resource_path('/'),
			'url'        => env('APP_URL') . '/storage',
			'visibility' => 'public',
		],

		's3'     => [
			'driver'                  => 's3',
			'key'                     => env('AWS_ACCESS_KEY_ID'),
			'secret'                  => env('AWS_SECRET_ACCESS_KEY'),
			'region'                  => env('AWS_DEFAULT_REGION'),
			'bucket'                  => env('AWS_BUCKET'),
			'url'                     => env('AWS_URL'),
			'endpoint'                => env('AWS_ENDPOINT'),
			'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Symbolic Links
	|--------------------------------------------------------------------------
	|
	| Here you may configure the symbolic links that will be created when the
	| `storage:link` Artisan command is executed. The array keys should be
	| the locations of the links and the values should be their targets.
	|
	 */

	// 'links' => [
	//     base_path('public') => base_path('../public'),
	//     storage_path('assets') => resource_path('assets'),
	//     public_path('assets') => resource_path('assets'),
	//     '/etc/systemd/system/medicus_queue.service' => app_path('Console/Commands/services/medicus_queue.service'),
	//     '/etc/systemd/system/medicus_websocket.service' => app_path('Console/Commands/services/medicus_websocket.service'),
	// ],

	'links'   => [
		// base_path('public') => base_path('../public'),
		// storage_path('assets') => resource_path('assets'),
		public_path('assets')              => resource_path('assets'),
		public_path('assets/js')           => resource_path('js'),
		public_path('assets/node_modules') => base_path('node_modules'),
		public_path('site.webmanifest')    => public_path('manifest.json'),
		public_path('webmainfest')         => public_path('manifest.json'),
	],

];
