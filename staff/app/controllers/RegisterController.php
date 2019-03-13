<?php
/**
* 
*/
class RegisterController extends Controller
{
	
	public function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		$this->load_model('User');

		$this->view->setLayout('default');

	}

	

	public function login()
	{
		if($_POST)
		{
			//form validation
			$this->validate->check($_POST, 
				[
				'username' => [
				  'display' => "Username",
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

  				$user = $this->User->findByUsername(Input::get('username'));
   // dnd($user);
 
				if($user && password_verify(Input::get('password'), $user->password))
				{
					$remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
			 	
			 	 
				$user->login($remember);

				Router::redirect('');
			    
				}
				else
					{ 
						$this->validate->addError("Wrong password provided");
					}
 
			}
 

		}
		$this->view->displayErrors = $this->validate->displayErrors();
		$this->view->render('register/login');

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
											'unique'=> 'users',
											'min'=> 6,
											'max'=> 30
											],

											'email'=> [
											'display'=> 'Email',
											'required'=> true,
											'unique'=> 'users', 
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
					$newUser = new User('user');
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
 
	if(currentUser())
	{
		//$this->User->logout();
currentUser()->logout();
	}
	Router::redirect('register/login');
}

 

}