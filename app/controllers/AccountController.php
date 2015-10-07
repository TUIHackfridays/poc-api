<?php

/**
 * Accounts Controller
 * The accounts controller uses the Laravel RESTful Resource Controller method.
 *
 * [http://laravel.com/docs/4.2/controllers#restful-resource-controllers]
 *
 * Following routes are supported
 * GET			/resource				index		resource.index
 * POST			/resource				store		resource.store
 * GET			/resource/{resource}	show		resource.show
 * PUT/PATCH	/resource/{resource}	update		resource.update
 * DELETE		/resource/{resource}	destroy		resource.destroy
 *
 * @SWG\Resource(
 *	apiVersion="poc",
 *	resourcePath="/accounts",
 *	description="All calls concerning Accounts",
 *	basePath="/poc",
 *	produces="['application/json']"	
 * )
 */
class AccountController extends BaseController {

	/**
	 *	Validation Rules
	 *	Based on Laravel Validation
	 */
	protected static $getRules = array
	(
		'id'=> 'required|integer',
		'type'=> ''
	);
	
	protected static $updateRules = array
	(
		'id'=> 'required|integer',
        'name'=> '',
        'unique'=> ''
	);

	protected static $postRules = array
	(	
		'name'=> 'required|min:2',
		'unique'=> 'required|min:2'
	);
	
	
	/**
	 *	RESTful actions
	 */
	 
	/**
	 * Get Accounts
	 *
	 * @return array
	 *
	 * @SWG\Api(
	 *	path="/accounts",
	 *	description="Accounts endpoint",
	 *	@SWG\Operation(method="GET", summary="List all accounts", @SWG\Partial("display"), @SWG\Partial("array200"), @SWG\Partial("error403"))
	 * )
	 *
	 * @SWG\Api(
	 *	path="/users/{modelId}/accounts",
	 *	@SWG\Operation(method="GET", summary="List all accounts from user", @SWG\Partial("display"), @SWG\Partial("modelId"), @SWG\Partial("array200"), @SWG\Partial("error403")
	 *	)
	 * )
 	 */
	public function index ($id=null)
	{
		$rules = null;
		$input = null;
		
		if ($id) 
		{
			$input = array('id'=> $id, 'type' => Request::segment(2));
			$rules = self::$getRules;
		}
		
		// Request Foreground Job
		$response = self::restDispatch ('index', 'AccountController', $input, $rules);
		
		return $response;
	}
	
	/**
	 * Post Account
	 *
	 * @return object
	 *
	 * @SWG\Api(
	 *	path="/accounts",
	 *	description="Accounts endpoint",
	 *	@SWG\Operation(method="POST", summary="Store new account", @SWG\Partial("display"), @SWG\Partial("schema200"), @SWG\Partial("error403"))
	 * )
	 */
	public function store ()
	{
		// Request Foreground Job
		$response = self::restDispatch ('store', 'AccountController', [], self::$postRules);
			
		return $response;
	}	
	
	/**
	 * Get Account
	 *
	 * @return object
	 *
	 * @SWG\Api(
	 *	path="/accounts/{modelId}",
	 *	description="Account object endpoint",
	 *	@SWG\Operation(method="GET", summary="Get account by id", @SWG\Partial("display"), @SWG\Partial("modelId"), @SWG\Partial("schema200"), @SWG\Partial("error403"), @SWG\Partial("error404"))
	 * )
	 */
	public function show ($id)
	{
		// Validation parameters
		$input = array ('id'=> $id);

		// Request Foreground Job
		$response = self::restDispatch ('show', 'AccountController', $input, self::$getRules);
			
		return $response;
	}
	
	/**
	 * Update Account
	 *
	 * @return object
	 *
	 * @SWG\Api(
	 *	path="/accounts/{modelId}",
	 *	description="Account object endpoint",
	 *	@SWG\Operation(method="PUT", summary="Update account by id", @SWG\Partial("display"), @SWG\Partial("modelId"), @SWG\Partial("schema200"), @SWG\Partial("error403"), @SWG\Partial("error404")),
	 *	@SWG\Operation(method="PATCH", summary="Partially update account by id", @SWG\Partial("display"), @SWG\Partial("modelId"), @SWG\Partial("schema200"), @SWG\Partial("error403"), @SWG\Partial("error404"))
	 * )
	 */
	public function update ($id)
	{
		// Validation parameters
        $input = array ('id'=> $id);

		// Request Foreground Job
		$response = self::restDispatch ('update', 'AccountController', $input, self::$updateRules);
		
		return $response;
	}
	
	/**
	 * Delete Accounts
	 *
	 * @return boolean
	 *
	 * @SWG\Api(
	 *	path="/accounts/{modelId}",
	 *	description="Account object endpoint",
	 *	@SWG\Operation(method="DELETE", summary="Soft delete account", @SWG\Partial("modelId"), @SWG\Partial("schema200"), @SWG\Partial("error403"), @SWG\Partial("error404"))
	 * )
	 */
	public function destroy ($id)
	{
		// Validation parameters
		$input = array ('id'=> $id);
	
		// Request Foreground Job
		$response = self::restDispatch ('destroy', 'AccountController', $input, self::$getRules);
		
		return $response;
	}

}
