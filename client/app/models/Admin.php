<?php
/**
* 
*/
class Admin extends Model
{
 
	
	public function __construct()
	{
		# code...
 
		//$table=  Pluralizer::plural($user);
	$table =  'admins'; 
		parent::__construct($table);
		 

	 
	}

	   

  
}