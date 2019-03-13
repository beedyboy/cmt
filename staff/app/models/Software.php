<?php
/**
* 
*/
class Software extends Model
{
	 
	
	public function __construct($model = '')
	{
		# code...
 
		$table=  Pluralizer::plural($model);
	 
		parent::__construct($table); 

	 


	}

	 

 
public function registerNewSubscriber($params)
{

	$this->assign($params); 
	$this->save();
}
 
}