<?php
/**
* 
*/
class Food extends Model
{
	
	function __construct($table)
	{
		# code...
		$table = "food";
		parent::__construct($table);
		
		$col = $this->get_columns();

		// dnd($col);
	}
}