<?php

/**
 *--------------------------------------------------------------------------
 * Swagger Application Documentation
 *--------------------------------------------------------------------------
 *
 * @SWG\Info(
 *	title="POC API",
 *	description="Join the Hyper SaaS Revolution",
 *	contact="info@poc-api.ninja"
 * )
 *
 * @SWG\Parameter(partial="modelId", name="modelId", description="ID of the trailing endpoint model", paramType="path", required=true, allowMultiple=false, type="integer")
 * @SWG\Parameter(partial="display", name="display", description="The schema display option (id, basic or full)", required=false, allowMultiple=false, type="string", defaultValue="full")
 *
 * @SWG\ResponseMessage(partial="schema200", code=200, message="Entity schema response")
 * @SWG\ResponseMessage(partial="array200", code=200, message="Entities array response")
 * @SWG\ResponseMessage(partial="error403", code=403, message="No valid authorization provided")
 * @SWG\ResponseMessage(partial="error404", code=404, message="Entity not found")
 */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 *	Get the version files
 */
include 'routes/routes-poc.php';


Route::get('/', function()
{
	$response = Response::make("HTTP/1.1 301 Moved Permanently", 301);

	$response->header ('Location', Config::get ('app.manuals_url'));

	return $response;
});