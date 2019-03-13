<?php
/**
* 
*/
class User extends Model
{
	
	function __construct($table)
	{
		# code...
		$table = "users";
		parent::__construct($table);
		
		$col = $this->get_columns();

		// dnd($col);
	}
}