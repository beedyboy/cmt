<?php
/**
* 
*/
class Auth extends Model
{
	private $_isLoggedIn, $_sessionName, $_cookieName; 
	public $sid = null;
	public static $currentLoggedInUser = null;
	
	public function __construct($user = '')
	{
		# code...
 
		//$table=  Pluralizer::plural($User);
	$table =  'users'; 
		parent::__construct($table);
		$this->_sessionName = CURRENT_USER_SESSION_NAME;
		$this->_cookieName = REMEMBER_ME_COOKIE_NAME;
	$this->_softDelete = true;

			if($user != '')
			{	 

				if(is_int($user))
				{
					$u = $this->_db->findFirst($table, ['conditions'=>'id= ?', 'bind'=>[$user]]);

				}
				else 
				{

					$u = $this->_db->findFirst($table, ['conditions'=>'acc_email= ?', 'bind'=>[$user]]);
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
	return self::$currentLoggedInUser;
}
	public function login( $id, $rememberme = false)
	{ 
		Session::set($this->_sessionName, $id); 
		#check if remember me button was checked
		if($rememberme)
		{
			 $hash = md5(uniqid() . rand(0, 100));

			$user_agent = Session::uagent_no_version();

			Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
			$fields = ['session'=>$hash, 'user_agent'=>$user_agent, 'user_id'=>$id]; 
			$this->_db->query("DELETE FROM usersessions WHERE user_id = ? AND user_agent = ?", [$id, $user_agent]);
		$qry =	$this->_db->insert('usersessions', $fields); 
		$this->sid = $this->_db->lastID();  
		}
	}


public static function loginUserFromCookie()
{
	
	$usersession = UserSession::getFromCookie();  
//check if user_id is not empty
//if not empty find the user
	if($usersession->user_id != '')
	{
		$user = new self((int)$usersession->user_id); 
		} 	
 
	if($user)
	{
		$user->login($usersession->user_id ); 
	}
	   
   return $user;
}
 

public function logout()
{
 
	$usersession = UserSession::getFromCookie();  
	 if($usersession) $usersession->_db->query("DELETE FROM usersessions WHERE user_id = ?", [$_SESSION[CURRENT_USER_SESSION_NAME]]); 
	//  if($usersession) $usersession->delete(currentUser()->id);
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