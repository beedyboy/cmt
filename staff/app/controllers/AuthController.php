<?php
/**
* 
*/
class AuthController extends Controller
{
	
	public function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		$this->load_model('Admin');

		$this->view->setLayout('default');

	}

	

 
    public function login()
    {
dnd(4758);
	$validation = new validate();
  		$this->view->displayErrors = $validation->displayErrors();
		
		if($_POST)
		{
  			$validation->check($_POST, [
 
											'email'=> [
											'display'=> 'Email',  
											'required'=> true,
											'max' => 50,
											'valid_email' => true
											],

											'password'=> [
											'display'=> 'Password',
											'required'=> true  
											] 
										]);

				if($validation->passed())
				{

		  				$admin = $this->Admin->findByEmail(Input::get('email')); 
		  	 
		 
						if($admin && password_verify(Input::get('password'), $admin->acc_password))
						{
							if($admin->acc_status == "Active"):
								$remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false; 
								$admin->login($remember); 
								Router::redirect('');
							else:

								$this->validate->addError("You have been banned from accessing this page. Please contact the administrator.");
					   		endif;
						}
						else
							{ 
								$this->validate->addError("Wrong password provided");
							}
				}
			}		 
	$this->view->displayErrors = $this->validate->displayErrors();
		$this->view->render('auth/login'); 
    }

	public function about(){
		dnd($_SESSION[CURRENT_USER_SESSION_NAME]);
	$this->view->render('register/about');

	}
public function create()
{

	$validation = new validate();

$posted_values = [

			'firstname'=> '','lastname'=> '','username'=> '','email'=> '','password'=> '','confirm'=> ''
					];

					if($_POST)
					{
						$posted_values = posted_values($_POST);

						$validation->check($_POST, [

											'firstname'=> [
											'display'=> 'First Name',
											'required'=> true
												],

											'lastname'=> [
											'display'=> 'Last Name',
											'required'=> true
											],

											'username'=> [
											'display'=> 'username',
											'required'=> true,
											'unique'=> 'admins',
											'min'=> 6,
											'max'=> 30
											],

											'email'=> [
											'display'=> 'Email',
											'required'=> true,
											'unique'=> 'admins', 
											'max' => 50,
											'valid_email' => true
											],

											'password'=> [
											'display'=> 'Password',
											'required'=> true, 
											'min'=> 6
											],

											'confirm'=> [
											'display'=> 'Confirm Password',
											'required'=> true,  
											'matches' => 'password'
											]
																		]);


				if($validation->passed())
				{
					$newUser = new Admin('admin');
					$newUser->registerNewUser($_POST);
					
					//$newUser->login();
					Router::redirect('register/login');


				}
					}
					$this->view->post = $posted_values;

					$this->view->displayErrors = $validation->displayErrors();

	$this->view->render('register/register');
}
public function logout()
{
	dnd(333);
 
	if(currentUser())
	{
		//$this->User->logout();
		currentUser()->logout();
	}
//	Router::redirect('auth/login');
}

 

}