<?php
	
/**
 *	Users Controller
 *	The users controller uses the Laravel RESTful Resource Controller method.
 *
 *	[http://laravel.com/docs/4.2/controllers#restful-resource-controllers]
 *
 *	Following routes are supported
 *	GET			/resource				index		resource.index
 *	POST		/resource				store		resource.store
 *	GET			/resource/{resource}	show		resource.show
 *	PUT/PATCH	/resource/{resource}	update		resource.update
 *	DELETE		/resource/{resource}	destroy		resource.destroy
 *
 * @SWG\Resource(
 *	apiVersion="poc",
 *	resourcePath="/users",
 *	description="All calls concerning Users",
 *	basePath="/poc",
 *	produces="['application/json']"	
 * )
 */
class UserController extends BaseController {

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
        'firstname'=> '',
        'name'=> '',
        'email'=> ''
	);

	protected static $postRules = array
	(	
		'firstname'=> 'required|min:2',
		'name'=> 'required|min:2',
		'email'=> 'required|min:2'
	);
	
	
	/**
	 *	RESTful actions
	 */
	 
	/**
	 *	Get Users
	 *
	 *	@return array
	 *
	 * @SWG\Api(
	 *	path="/users",
	 *	description="Users endpoint",
	 *	@SWG\Operation(method="GET", summary="List all users", @SWG\Partial("display"), @SWG\Partial("array200"), @SWG\Partial("error403"))
	 * )
	 *
	 * @SWG\Api(
	 *	path="/accounts/{modelId}/users",
	 *	@SWG\Operation(method="GET", summary="List all users from account", @SWG\Partial("display"), @SWG\Partial("modelId"), @SWG\Partial("array200"), @SWG\Partial("error403")
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
		$response = self::restDispatch ('index', 'UserController', $input, $rules);
		
		return $response;
	}
	
	/**
	 *	Post User
	 *
	 *	@return object
	 *
	 * @SWG\Api(
	 *	path="/users",
	 *	description="Users endpoint",
	 *	@SWG\Operation(method="POST", summary="Store new user", @SWG\Partial("display"), @SWG\Partial("schema200"), @SWG\Partial("error403"))
	 * )
	 */
	public function store ()
	{
		// Request Foreground Job
		$response = self::restDispatch ('store', 'UserController', [], self::$postRules);
			
		return $response;
	}	
	
	/**
	 * Get User
	 *
	 * @return object
	 *
	 * @SWG\Api(
	 *	path="/users/{modelId}",
	 *	description="User object endpoint",
	 *	@SWG\Operation(method="GET", summary="Get user by id", @SWG\Partial("display"), @SWG\Partial("modelId"), @SWG\Partial("schema200"), @SWG\Partial("error403"), @SWG\Partial("error404"))
	 * )
	 */
	public function show ($id)
	{
		// Validation parameters
		$input = array ('id'=> $id);

		// Request Foreground Job
		$response = self::restDispatch ('show', 'UserController', $input, self::$getRules);
			
		return $response;
	}
	
	/**
	 * Update User
	 *
	 * @return object
	 *
	 * @SWG\Api(
	 *	path="/users/{modelId}",
	 *	description="User object endpoint",
	 *	@SWG\Operation(method="PUT", summary="Update user by id", @SWG\Partial("display"), @SWG\Partial("modelId"), @SWG\Partial("schema200"), @SWG\Partial("error403"), @SWG\Partial("error404")),
	 *	@SWG\Operation(method="PATCH", summary="Partially update user by id", @SWG\Partial("display"), @SWG\Partial("modelId"), @SWG\Partial("schema200"), @SWG\Partial("error403"), @SWG\Partial("error404"))
	 * )
	 */
	public function update ($id)
	{
		// Validation parameters
        $input = array ('id'=> $id);

		// Request Foreground Job
		$response = self::restDispatch ('update', 'UserController', $input, self::$updateRules);
		
		return $response;
	}
	
	/**
	 * Delete Users
	 *
	 * @return boolean
	 *
	 * @SWG\Api(
	 *	path="/users/{modelId}",
	 *	description="User object endpoint",
	 *	@SWG\Operation(method="DELETE", summary="Soft delete user by id", @SWG\Partial("display"), @SWG\Partial("modelId"), @SWG\Partial("schema200"), @SWG\Partial("error403"), @SWG\Partial("error404"))
	 * )
	 */
	public function destroy ($id)
	{
		// Validation parameters
		$input = array ('id'=> $id);
	
		// Request Foreground Job
		$response = self::restDispatch ('destroy', 'UserController', $input, self::$getRules);
		
		return $response;
	}

}
