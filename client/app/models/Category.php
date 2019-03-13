<?php
/**
* 
*/
class Category extends Model
{
	
	function __construct($table)
	{
		# code...
		$table = "categories";
		parent::__construct($table);
		
		$col = $this->get_columns();

		// dnd($col);
	}
}