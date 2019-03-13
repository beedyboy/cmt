<?php
/**
* 
*/
class Auth extends Model
{
	private $_isLoggedIn, $_sessionName, $_cookieName; 
	public $sid = null;
	public static $currentLoggedInUser = null;
	
	public function __construct($admin = '')
	{
		// dnd("i have been called");
		# code...
 
		//$table=  Pluralizer::plural($admin);
	$table =  'admins'; 
		parent::__construct($table);
		$this->_sessionName = CURRENT_USER_SESSION_NAME;
		$this->_cookieName = REMEMBER_ME_COOKIE_NAME;
	$this->_softDelete = true;

 if($admin != '')
	{	 

		if(is_int($admin))
		{
			$u = $this->_db->findFirst($table, ['conditions'=>'id= ?', 'bind'=>[$admin]]);

		}
		else 
		{
 
			$u = $this->_db->findFirst($table, ['conditions'=>'email= ?', 'bind'=>[$admin]]);
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

	public function findByEmail($email)
	{ 
 
		 return $this->findFirst(['conditions'=> 'email  = ?', 'bind'=> [$email]]);
	 
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
// dnd("Not logged IN");
 		Router::redirect('login');
 	endif;

}
	public static function auth($field)
	{ 

  		  $u = new Admin('admin');
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

			$admin_agent = Session::uagent_no_version();
	
			Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);

			$fields = ['session'=>$hash, 'user_agent'=>$admin_agent, 'admin_id'=>$this->id];
 
			$this->_db->query("DELETE FROM adminsessions WHERE admin_id = ? AND user_agent = ?", [$this->id, $admin_agent]);
		$qry =	$this->_db->insert('adminsessions', $fields);
		$this->sid = $qry->_lastInsertedID;
		}
	}


public static function loginuserFromCookie()
{
	$adminSession = adminSession::getFromCookie(); 
 
	if($adminSession->admin_id != '')
	{
		$admin = new self((int)$adminSession->admin_id);
	 
	}

	if($admin)
	{
		$admin->login(); 
	}
	 		   
   return $admin;
}
 

public function logout()
{

	$adminSession = adminSession::getFromCookie(); 
	 if($adminSession) $adminSession->_db->query("DELETE FROM adminsessions WHERE admin_id = ?", [$_SESSION[CURRENT_USER_SESSION_NAME]]); 
	 //if($adminSession) $adminSession->delete(currentuser()->id);
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