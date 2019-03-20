<?php
/**
* 
*/
class Activity extends Model
{
	
	function __construct($table)
	{ 
		parent::__construct($table);
		
		$col = $this->get_columns(); 
	}
}