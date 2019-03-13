<?php
/**
* 
*/
class LogoutController extends Controller 
{
	
	public function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		$this->load_model('Admin'); 

	}
 

    
 
public function index()
{
  
   
  if(currentUser())
  {
    //$this->User->logout();
    currentUser()->logout();
  }
 Router::redirect('/');
}


        //ends
} 

