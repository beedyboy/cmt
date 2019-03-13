<?php
/**
* 
*/
class SettingsController extends Controller
{
	
	function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		$this->load_model('Application');
		  
		 // if(!Auth::check()): Router::redirect('auth/login'); endif;
		  
	}


/* public function getSettings()
{
	return $data  = $this->Application->find();
}
 */
public function index()
{
	 $this->view->displayErrors = $this->validate->displayErrors();  
 	$this->view->data  = $this->Application->findFirst();
		$this->view->render('settings/index'); 
		$this->view->extra('layouts/beedy_kaydee');  
}

 
 

public function update()
{	
 
  $db = DB::getInstance();

  if($_POST)
		{
			$data = array(); 
			$this->validate->check($_POST, [  'paging'=> [
													'display'=> 'Page Count',
													'is_numeric'=> true,
													'required'=> true 
												]
										]);
		  
		   if($this->validate->passed())
		   {
		
			$Settings = $this->Application->findFirst();
			
			$tm =setTimeStamp();
		   		if($Settings->pageLimit != Input::get('paging') || $Settings->usermode  !=  Input::get('usermode') )
		   		{  
					 $bswitch = Input::get('usermode');
					 $paging = Input::get('paging');
					 $getUserId =getUserId();
					 //update the db
				 $send = $db->query("UPDATE applications SET  usermode =  '$bswitch',  pageLimit = '$paging',  updated_at = '$tm' , updated_by = '$getUserId' ");
				   
					  
		   			//check if updated
		   			if($send)
		   			{
							$data['status'] = "success";
							$data['msg']  =   'Debrise Settings has been updated successfully';
   				  
		   			}
		   			else
		   			{
		   				$data['status'] = "db_error";
		   				$data['msg'] = "Error: Debrise Settings was not saved. Please try again later";
		   			}
				   }
				   else
				   {
					   
				   }
			 
					unset($_POST);
				 
		   }
		   else
		   {
					 	$data['status'] = "error";
						$data['msg'] = $this->validate->displayErrors();
		   }
		   echo json_encode($data);  
 					
 		}
	 
 //update ends down here
}
  

}