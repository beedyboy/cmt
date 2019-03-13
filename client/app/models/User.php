<?php
/**
* 
*/
class User extends Auth
{
 
	
	public function __construct()
	{
		# code...
 
		//$table=  Pluralizer::plural($user);
	$table =  'users'; 
		parent::__construct($table);
		 

	 
	}

	   

  
}