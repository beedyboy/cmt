<?php
/**
* 
*/
class View
{
	 protected $_head, $_body, $_scripts, $_styles, $_siteTitle, $_outputBuffer, $_layout = DEFAULT_LAYOUT;
	// protected $data = [];

	 public function __construct()
	 {

      // $this->Beedy = new Beedy();	

	 }

	 public function render($viewName, $vars = array(), $return = FALSE)
	 {
	 	$viewAry = explode('/', $viewName);

	 	$viewString = implode(DS, $viewAry);

	 	if(file_exists(ROOT . DS . 'resources' . DS . 'views'. DS . $viewString. '.php'))
	 	{
	 			include(ROOT . DS . 'resources'. DS. 'views' . DS . $viewString . '.php');
	 	include(ROOT . DS . 'resources'. DS. 'views' . DS . 'layouts'. DS .  $this->_layout . '.php');

	 	} else 
	 	{
	 		die('The view \"'. $viewName. '\" does not exist');
	 	}

	 }


	 public function extra($viewName)
	 {
	 	$viewAry = explode('/', $viewName);

	 	$viewString = implode(DS, $viewAry);

	 	if(file_exists(ROOT . DS . 'resources' . DS . 'views'. DS . $viewString. '.php'))
	 	{
	 			include(ROOT . DS . 'resources'. DS. 'views' . DS . $viewString . '.php'); 
 
	 	} else 
	 	{
	 		die('The view \"'. $viewName. '\" does not exist');
	 	}

	 }



public function with($data)
{

  return $this->data[] =  $data;
 
	//return $this->data = $data;
}



public function content($type)
{
	if($type == 'head')
	{
		return $this->_head;
	} else if($type == 'body')
	{
		return $this->_body;
	}
 else if($type == 'scripts')
	{
		return $this->_scripts;
	}

	return false;
}




public function start($type)
{
	$this->_outputBuffer = $type;
	ob_start();
	
}




public function end()
{
	if($this->_outputBuffer == 'head')
	{
		$this->_head = ob_get_clean();
	} elseif ($this->_outputBuffer == 'body')
	{
 
		$this->_body = ob_get_clean();
	} elseif ($this->_outputBuffer == 'scripts')
	{
 
		$this->_scripts = ob_get_clean();
	} else 
	{
		die('You must first run the start method');
	}
}





public function siteTitle()
{
	return $this->_siteTitle;
	
}



public function setSiteTitle($title)
{$this->_siteTitle = $title;
	
}



public function setLayout($path)
{
	$this->_layout = $path;
}





/*****
	**** Load a module view ****
	public function view($view, $vars = array(), $return = FALSE)
	{
		
ob_start();
$data = ['orange', 'pine', 'sherry', 'Guava', 'Mango'];
$file = 'create';
	$file_ext = (pathinfo($file, PATHINFO_EXTENSION)) ? $file : $file.'.php'; // this will give me create.php
		dnd($data);
		$m = ob_get_contents();
		ob_end_clean();
echo $m;

		return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
	}

	***/
//is_object($object) ? get_object_vars($object) : $object;
//list($path, $_view) = Modules::find($view, $this->_module, 'views/');

//$file_ext = (pathinfo($file, PATHINFO_EXTENSION)) ? $file : $file.EXT;
		
}