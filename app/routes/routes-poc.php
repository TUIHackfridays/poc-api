<?php

/**
 *	Guest endpoints. No OAuth2 required
 */
Route::group (array('prefix'=> 'poc'), function() 
{	
	# System
	Route::get('version', 'PocController@apiversion');
	
	# Hello
	Route::get('hello', 'PocController@hello');
});


/**
 *	Authorized endpoints.
 */
Route::group (array('prefix'=> 'poc', 'before'=> 'auth', 'after'=> 'evaluate'), function() 
{
	# API Objects
	# Accounts
	Route::resource	('accounts', 				'AccountController',	array ('except' => array('create', 'edit')));
	
	# Accounts variations
	Route::resource	('users.accounts',		    'AccountController',	array ('except' => array('create', 'edit')));

	# Users
	Route::resource	('users',	                'UserController',	    array ('except' => array('create', 'edit')));
	
	# Users variations
	Route::resource	('accounts.users',		    'UserController',	    array ('except' => array('create', 'edit')));

});