<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	# API Headers
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, PUT, PATCH, POST, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
	header('Access-Control-Allow-Credentials: true');
});


/*App::after(function($request, $response)
{
	$response->header ('Content-Type', 'application/json');
});*/

/*
|--------------------------------------------------------------------------
| Authentication Filter
|--------------------------------------------------------------------------
|
| The following filter is used to verify that the user of the current
| session has a authentication token.
|
*/

Route::filter ('auth', function()
{
	// Default bearer
	$bearer = Request::header ('Authorization');
	
	// Get based bearer, debug only
	if(!$bearer && Config::get ('app.debug'))
	
		$bearer = Input::get('bearer');
	
	if(!$bearer || strlen ($bearer) < 18)
	
		throw new \InvalidUserException ('no valid authorization provided');
	

	// Add Access token to input
	$bearer = explode(' ', $bearer);
	
	Input::merge (array('access_token'=> array_pop ($bearer)));
});


/*
|--------------------------------------------------------------------------
| Evaluation After-Filter
|--------------------------------------------------------------------------
|
| The following filters is used to add error response verification;
| both success and error responses are json flavoured. 
|
*/

Route::filter ('evaluate', function ($route, $request, $response)
{
	# Add json header
	$response->header ('Content-Type', 'application/json');


	# Error catching
	if (preg_match ('/error/', substr ($response->original, 2, 8)))
			
		throw new WorkerException ($response->original);	
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter ('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
