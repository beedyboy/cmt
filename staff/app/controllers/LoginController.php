<?php

/**
* 
*/
class LoginController extends Controller
{
	
	public function __construct($controller, $action)
	{
		// dnd("i have been called");
		# code...
		parent::__construct($controller, $action);
		$this->load_model('Admin');

		$this->view->setLayout('default');

	}

	

	public function index()
	{
 
 
		if($_POST)
		{
			//form validation
			$this->validate->check($_POST, 
				[
				'username' => [
				  'display' => "username",
				  'required' => true
				],
				'password' => [
				'display' => "Password",
				  'required' => true,
				  'min'=> 6
				]
				]
				);
			 
			if($this->validate->passed())
			{

 				 $db = DB::getInstance(); 
  				$Admin = $this->Admin->findByusername(Input::get('username'));
    
				if($Admin && password_verify(Input::get('password'), $Admin->password))
				{
					$remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
			 	
			 	 
				$Admin->login($remember);

				Router::redirect('');
			    
				}
				else
					{ 
						$this->validate->addError("Incorrect Credentials, Try again...");
					}
 
			}
 

		}
		$this->view->displayErrors = $this->validate->displayErrors();
		$this->view->render('register/login');

	}
  
 public function authenticate()
 	{
	 $data = array('error' => false);
	
			//form validation
			$this->validate->check($_POST, 
				[
				'email' => [
				  'display' => "email",
				  'valid_email'=>true,
				  'required' => true
				],
				'password' => [
				'display' => "Password",
				  'required' => true,
				  'min'=> 6
				]
				]
				);
			 
			if($this->validate->passed())
			{ 
 				 $db = DB::getInstance(); 
  				$Admin = $this->Admin->findByEmail(Input::get('email'));
    
				if($Admin && password_verify(Input::get('password'), $Admin->password))
				{
					 
					$remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
			 	
			 	 
				$Admin->login($remember);
				
				$data['error'] = false;
				 $data['status'] = "green";
				 $data['msg'] = "Login Successful";
			    
				}
				else
					{ 
						$data['error'] = true;
						$data['status'] = "yellow";
						$this->validate->addError("Incorrect Credentials, Try again...");
						$data['errorList'] = 	$this->validate->displayErrors();
					}
 
			}
			else {
				$data['error'] = true;
				$data['status'] = "red";
				$data['errorList'] = 	$this->validate->displayErrors();
			}
 
 
		header("Content-type: application/json");
		 
		echo json_encode($data);


 	}

}