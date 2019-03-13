<?php 	 
// ini_set('display_errors',1); ini_set('display_startup_errors',1); error_reporting(-1);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
define('ENVIRONMENT', 'development');
 
if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		break;

		case 'testing':
		case 'production':
			error_reporting(0);
			// ini_set('display_errors', 1);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}

define('DS', DIRECTORY_SEPARATOR);
 
define('ROOT', dirname(__FILE__));
 
//load configuration and helper functions
 

require_once(ROOT . DS . 'config' . DS . 'config.php');

require_once(ROOT . DS . 'app' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');

 
/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Drivers
| 4. Helper files
| 5. Custom config files
| 6. Language files
| 7. Models
|
*/

function autoload($className)
{
	if(file_exists(ROOT . DS . 'core'. DS . $className . '.php'))
	{
		require_once(ROOT . DS . 'core'. DS . $className . '.php');
	}
	elseif(file_exists(ROOT . DS . 'app'. DS . 'controllers' . DS .$className . '.php'))
	{
		require_once(ROOT . DS . 'app'. DS . 'controllers' . DS .$className . '.php');
	}

	elseif(file_exists(ROOT . DS . 'app'. DS . 'models' . DS .$className . '.php'))
	{
		require_once(ROOT . DS . 'app'. DS . 'models' . DS .$className . '.php');
	}

}

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/

spl_autoload_register('autoload');


session_start();
 
/*
| -------------------------------------------------------------------
| POS
| -------------------------------------------------------------------
| This file loads the default software settings.
| 
|
| -------------------------------------------------------------------
*/
 
 
$newSetting = new Application('applications'); 
 
define('PAGE_LIMIT', $newSetting->findFirst()->pageLimit); 

 # check if a session does not exist and the cookie exist
 # otherwise take to login page


// if(!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)):
 
// 	#login from cookie
// 	  Admin::loginAdminFromCookie(); 
	 
// endif;

 
	Router::init();

/*if(!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME))
{
	dnd("No session");
	User::loginUserFromCookie();
}
dnd(Session::get(CURRENT_USER_SESSION_NAME));*/

 