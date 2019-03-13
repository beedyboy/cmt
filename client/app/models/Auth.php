<?php
/**
* 
*/
class Auth extends Model
{
	private $_isLoggedIn, $_sessionName, $_cookieName; 
	public $sid = null;
	public static $currentLoggedInUser = null;
	
	public function __construct($User = '')
	{
		# code...
 
		//$table=  Pluralizer::plural($User);
	$table =  'users'; 
		parent::__construct($table);
		$this->_sessionName = CURRENT_USER_SESSION_NAME;
		$this->_cookieName = REMEMBER_ME_COOKIE_NAME;
	$this->_softDelete = true;

 if($User != '')
	{	 

		if(is_int($User))
		{
			$u = $this->_db->findFirst($table, ['conditions'=>'id= ?', 'bind'=>[$User]]);

		}
		else 
		{

			$u = $this->_db->findFirst($table, ['conditions'=>'acc_email= ?', 'bind'=>[$User]]);
		}

		if($u)
		{
			foreach ($u as $key => $value) 
			{
				# code...
			$this->$key  = $value;
			}
		}
	}

 

	}

	public function findByEmail($acc_email)
	{ 
 
		 return $this->findFirst(['conditions'=> 'acc_email  = ?', 'bind'=> [$acc_email]]);
	 
	}
	
	/**
	 * authentication
	 * @return [type] [description]
	 */
public static function check()
{  
	if( empty($_SESSION))
	{
		return false;
	}

	else{
		return true;
	}

}
/**
 * is user logged in ?
 * @return a view page [ home | login page]
 */
public static function isLoggedIn()
{
 	if( empty($_SESSION)):

 		Router::redirect('login');
 	endif;

}
	public static function auth($field)
	{ 

  		  $u = new User('User');
	   $uid = Session::get(CURRENT_USER_SESSION_NAME); 
// dnd($uid);
	   if($u->check()):

	 return $u->findById($uid)->$field;
	 // return $u->findById($uid)->$field;
	else:
		return false;
	endif;
	}
	
public static function currentLoggedInUser()
{
	if(!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME))
	{ 
		 $u = new Auth((int)Session::get(CURRENT_USER_SESSION_NAME)); 
 		 self::$currentLoggedInUser = $u;
	 
	}
	 // dnd(self::$currentLoggedInUser);
	return self::$currentLoggedInUser;
}
	public function login($rememberme = false)
	{ 
		Session::set($this->_sessionName, $this->id); 
		#check if remember me button was checked
		if($rememberme)
		{
			 $hash = md5(uniqid() + rand(0, 100));

			$user_agent = Session::uagent_no_version();
	
			Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);

			$fields = ['session'=>$hash, 'user_agent'=>$user_agent, 'user_id'=>$this->id];
 
			$this->_db->query("DELETE FROM usersessions WHERE User_id = ? AND user_agent = ?", [$this->id, $user_agent]);
		$qry =	$this->_db->insert('usersessions', $fields);
		$this->sid = $qry->_lastInsertedID;
		}
	}


public static function loginUserFromCookie()
{
	$usersession = usersession::getFromCookie(); 
 
	if($usersession->User_id != '')
	{
		$User = new self((int)$usersession->User_id);
	 
	}

	if($User)
	{
		$User->login(); 
	}
	 		   
   return $User;
}
 

public function logout()
{

	$usersession = usersession::getFromCookie(); 
	 if($usersession) $usersession->_db->query("DELETE FROM usersessions WHERE user_id = ?", [$_SESSION[CURRENT_USER_SESSION_NAME]]); 
	 //if($usersession) $usersession->delete(currentUser()->id);
	Session::delete(CURRENT_USER_SESSION_NAME);
	if(Cookie::exists(REMEMBER_ME_COOKIE_NAME))
	{
		Cookie::delete(REMEMBER_ME_COOKIE_NAME);
	}
	unset($_SESSION);
	return true;
}

 
public function registerNewUser($params)
{

	$this->assign($params);
	$this->password = password_hash($this->password, PASSWORD_DEFAULT);
	$this->save();
}

//check if 
 
}