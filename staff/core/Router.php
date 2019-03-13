<?php

/**
* 
*/
class Router
{
	
	 /**
	  *
	  * Create an init function
	  * check for the server address
	  * if empty, return to custom page
	  * other wise break it down
	  * call the controller class
	  * call methods
	  * set error controller
	  * 
	  * 
	  */

protected $_uri = [];
protected $_default_controller = DEFAULT_CONTROLLER;
protected $_controller = null;
protected $_controllerName = null;
protected $_method = null;
protected $_params = [];
protected $_errors = [];

/*
| -------------------------------------------------------------------
| GET SERVER ADDRESS (URL)A
| -------------------------------------------------------------------
| Fetches the $_GET from 'url'
| Remove the Trailing slash
| Sanitize and explode
| 
| -------------------------------------------------------------------
*/ 
  
		protected  function serverAddress()
		{
		$url = isset($_GET['url']) ? $_GET['url'] : null ; 
		 //$url = trim($url);
		 $url = rtrim($url, '/');
		 $url = filter_var($url, FILTER_SANITIZE_URL);
		 $this->_uri = explode('/', $url); 
		 
		}
	
	/*
| -------------------------------------------------------------------
|  START THE APP
| -------------------------------------------------------------------
| This should get and call an existing controller
| 
| -------------------------------------------------------------------
*/ 	
public static function init()
{

 $thisClass = new self;
 $thisClass->serverAddress();  
//  dnd("this is a feelimg");
 if(!empty($thisClass->_uri[0]))
 {

 $thisClass->getController();
 $thisClass->_callControllerMethod();

/*  //acl check
	$grantAccess = self::hasAccess($thisClass->_controller, $thisClass->_method);

	if(!$grantAccess)
	{
		$thisClass->_controllerName = ACCESS_RESTRICTED;
				$thisClass->_method = 'index';
	}
*/
	
  $thisClass->_getParams();
 
  $thisClass->_dispatch();

 }
 	else
 	{
 
 		//load default controller 
$thisClass->_defaultController();
	 }

// dnd($thisClass->_uri);
}



 /**
     * Load an default controller if there IS no url passed
     * 
     * @return boolean|string
     */
    protected function _defaultController()
    {


    	$file  = 'app/controllers/'. $this->_default_controller . '.php';
	
			try {
					if(!file_exists($file))
						{
							throw new Exception("Error Processing Request $file does not exist", 1);
							$this->_errors['Not Found'] = $this->_default_controller;
							return false;
						}
						else{
						$this->_controllerName = $this->_default_controller;
						$this->_method = DEFAULT_CONTROLLER_METHOD;

		  				$this->_dispatch();;
						
							}
			} catch (Exception $e) 
			{
				
			echo $e->getMessage();
			}
    }
    
    /**
     * Load an existing controller if there IS a GET parameter passed
     * 
     * @return boolean|string
     */
private function getController()
{
 
	$this->_controller = ucwords($this->_uri[0]);

	array_shift($this->_uri);
	$this->_controllerName = $this->_controller	. 'Controller';		
	$file  = 'app/controllers/'. $this->_controllerName . '.php';
	
			try {
			if(!file_exists($file))
				{
					throw new Exception("Error Processing Request $file does not exist", 1);
					$this->_errors['Not Found'] = $this->_controllerName;
					return false;
				}
				else{
					 return true;
					}
			} catch (Exception $e) 
			{
				
			echo $e->getMessage();
			}
				

}
  /**
     * If a method is passed in the GET url paremter
     * 
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     */
    private function _callControllerMethod()
    {
        	//$this->_method =  $this->_uri[0]  ??   'index';
				$this->_method = isset($this->_uri[0]) ? $this->_uri[0] : 'index';
			
			//dnd($this->_method);
			array_shift($this->_uri);
  

    }
     /**
     * set the remaining value as parameters
     * 
     * @return string
     */
    
private function _getParams()
{	
	 
	$this->_params = $this->_uri;
}
 /**
     * Dispatch the url call to the right channel
     * 
     * @return boolean
     */
private function _dispatch()
{
 
 		$dispatch = new $this->_controllerName($this->_controllerName, $this->_method);

			if(method_exists($this->_controllerName, $this->_method))
			{
				call_user_func_array([$dispatch, $this->_method], $this->_params);
			}
			 else
			{
				die("This method $this->_method does not exist in the controller");
			}
		$this->_error();
 
	//$controller = $this->_uri[0];
 

}
 /**
     * Display an error page if nothing exists
     * 
     * @return boolean
     */
public function _error()
{
	$count = 1;
	foreach ($this->_errors as $key => $value)
	 {
		# code...
		if($key =="Not Found"):

		echo "Error $count : This file ($value) could not be found";

endif;
	}
	$count++;
}



	public static function redirect($location)
	{
		if(!headers_sent())
		{
			header('Location: '.base_url.$location);
			exit();
		} else {
			echo '<script type="text/javascript">';
			echo 'window.location.href="'.base_url.$location.'";';

			echo '</script>';
			
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url='.base_url.$location.'">'; 

			echo '</noscript>'; exit;

		}
	}


public static function hasAccess($controller_name, $action_name='index')
{
	 
	 //user is a guest
	// $acl_file = file_get_contents('app' . DS . 'acl.json');
	//turn to array after decoding
	// $acl = json_decode($acl_file, true);
	//default access is Guest
	 
	$current_user_acls =array();

	 

$Guest = ['Guest'=> ['login']]; 
	$current_user_acls = array_merge($Guest);
	$grantAccess = false; 
		if(Session::exists(CURRENT_USER_SESSION_NAME))
		{
		 

				$LoggedIn = ['Auth'=> ['logout','home']];  
				$current_user_acls = array_merge($LoggedIn);
		  		$permissions = array_merge_recursive($current_user_acls,currentUser()->acls());
				 
				  

			 if($controller_name == "Company" || $controller_name == "Feature" || $controller_name == "Report"):

			 	$grantAccess = true;


			 	endif;

			if(array_key_exists( ucwords($controller_name), $permissions))
			{ 
			 

				if(!empty($permissions[$controller_name]))
				{
					 
					if($controller_name == 'Auth' && $action_name == 'login'):
						$grantAccess = false;
					else:
						$grantAccess = true;
				 
					endif;
					
					 
				 }
				 else if(empty($permissions[$controller_name]) && $action_name == "profile")
				 {
				 	$grantAccess = true;
				 }
			} 
		 	 
		}
		else
		{
			//do for guest
			if(array_key_exists( 'Guest', $current_user_acls))
			{ 
			 
				if($controller_name == 'Auth' && $action_name == 'login'):
					$grantAccess = true;
				else:
					$grantAccess = false;
				endif;

				 
			} 

		}
 
 return $grantAccess;
}
  
private static function get_link($val)
{
	//check if external link
	if(preg_match('/https?:\/\//',	$val) == 1)
	{
		return $val;
	} else {
		$uAry = explode(DS, $val);  
		$controller_name = ucwords($uAry[0]);


		$action_name = (isset($uAry[1])) ? $uAry[1] : '';

	//dnd($action_name);

		//	return base_url . $val;
 
		//if the menu i
		if(self::hasAccess($controller_name, $action_name))
		{
			return base_url . $val;
		}
		return false;

	 
	}
}

	//and the class ends here
}