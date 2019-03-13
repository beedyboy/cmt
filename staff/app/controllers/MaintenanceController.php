<?php
/**
* 
*/
class MaintenanceController extends Controller
{
	
	public function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		 
		$this->view->setLayout('default');

 
	}

public function index()
{ 
 $db = DB::getInstance();  
 $this->view->render("site/index");
}

}