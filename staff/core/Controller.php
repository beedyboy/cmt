<?php
/**
* 
*/
class Controller extends Cmt
{
	protected $_controller, $_action;
	public $view, $validate;

	public function __construct($controller, $action)
	{
		# code...
		parent::__construct();
		$this->_controller = $controller;
		$this->_action = $action;

		$this->view  = new View();
		$this->validate  = new Validate(); 
		$this->admin_id = Auth::auth('id'); 
	}

	protected function load_model($model)
	{
		//$model =  Pluralizer::plural($model);
		// dnd($model);
		if(class_exists($model))
		{
			$this->{$model} = new $model(strtolower($model));
		
		}
		else{
			die("This model  $model does not exist");

		}
	}
}