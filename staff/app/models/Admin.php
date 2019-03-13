<?php
/**
* 
*/
class Admin extends Auth
{
 
	
	public function __construct()
	{
		# code...
 
		//$table=  Pluralizer::plural($user);
	$table =  'admins'; 
		parent::__construct($table);
		 

	 
	}

	   

  
}