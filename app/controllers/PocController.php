<?php

class PocController extends BaseController {

	/**
	 *	Hellow World
	 */
	public function hello ()
	{

		return self::jobdispatch ( 'controllerDispatch', (object) array
		(
			'action'=> 'adhoc',
			'controller'=> 'DispatchController',
			'payload'=> isset ($payload)? $payload: null
		));

		# Default start of project
		// return Response::json (["response"=> "Hello, World!"]);
	}

	/**
	 *	Get the API version
	 */
	public function apiversion ()
	{
		# Default version on config file
		return Response::json (Config::get ('app.version'));
	}

}
