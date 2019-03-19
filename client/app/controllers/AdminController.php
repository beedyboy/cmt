<?php
/**
* 
*/
class AdminController extends Controller 
{
	
	public function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
        $this->load_model('Admin'); 
        // Auth::isLoggedIn();

	}
 

    /**
     * Display a listing of the resource.
     *
     * @return \Router\View
     */
     
  
  
  //ends
} 

