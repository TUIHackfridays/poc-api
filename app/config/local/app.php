<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => true,
	
	/*
	|--------------------------------------------------------------------------
	| Synchronized
	|--------------------------------------------------------------------------
	| If set, the API will call the worker directly, instead of using a jobserver.
	*/
	
	'synchronized' => true,
	
	/*
	|--------------------------------------------------------------------------
	| Worker path
	|--------------------------------------------------------------------------
	| This path is used by the local Jobserver to sync a queue request.
	*/
	'worker' => array
	(
		'path' => '/path/to/worker/jobs'
	)
);
