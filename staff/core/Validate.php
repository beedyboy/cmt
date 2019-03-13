<?php
class Validate
{

private $_passed= false, $_errors = [], $_db = null;

public function __construct()
{
	$this->_db = DB::getInstance();
}


public function exist($table, $params=[])
{

	$id = $params[0];
	$item =$params[1];
	$value =$params[2];
	 
	$query = $this->_db->query("SELECT * FROM {$table} WHERE org_id = ? AND {$item} = ?", [$id,$value]);
 return $query->count();
 /*
 $count = $this->validate->exist('categories',[$this->view->Beedy->getCompanyId(), 'cat_name', Input::get('cat_name')]);

		 dnd($count);
  */
}

public function check($source, $items=[])
{

$this->_errors = []; 
foreach ($items as $item => $rules)
 {
	# code...
 	//sanitize our item
 	$item = Input::sanitize($item);
 	$display = $rules['display'];

 	foreach ($rules as $rule => $rule_value)
 	 {
 		# code...
 		$value = Input::sanitize(trim($source[$item]));

 		if($rule === 'required' && empty($value))
 		{
 			$this->addError([" {$display} is required", $item]);
 		} else if(!empty($value))
 		{
 			switch ($rule) {
 				case 'min':
 					# code...
 					if(strlen($value) < $rule_value)
 					{
 						$this->addError(["{$display} must be a minimum of {$rule_value} characters.", $item]);
 					}
 					break;

 				case 'max':
 					# code...
 					if(strlen($value) > $rule_value)
 					{
 						$this->addError(["{$display} must be a maximum of {$rule_value} characters.", $item]);
 					}
 					break;
 				
 				case 'matches':

 					if($value != $source[$rule_value])
 					{
 						$matchDisplay = $items[$rule_value]['display'];
 						$this->addError(["{$matchDisplay} and {$display} must match.", $item]);

 					}
 					break;

 				case 'unique':
 					# code...
 				 
 						$check = $this->_db->query("SELECT {$item} FROM {$rule_value} WHERE {$item} = ?", [$value]);
 						if($check->count())
 						{
 							$this->addError(["{$display} already exist. Please choose another.", $item]);
 						}
 						break;

 				case 'unique_update':
 						# code...
 							
 						$t = explode(',', $rule_value);
 						$table = $t[0];
 						$id = $t[1];
 						$query = $this->_db->query("SELECT * FROM {$table} WHERE id != ? AND {$item} = ?", [$id,$value]);
 						if($query->count())
 						{
 							$this->addError([" {$display} already exists. Please choose another.", $item]);
 						}

 						break;

 				case 'insert_unique':
 						# code...
 							
 						// $t = explode(',', $rule_value);
 						$t =  $rule_value;
 					 
 						$table = $t[0]; 
 						$id = $t[1];
 						$query = $this->_db->query("SELECT * FROM {$table}  {$item} = ?", [$value]);
 						if($query->count() >= 1)
 						{
 			 
 							$this->addError([" {$display} already exists. Please choose another.", $item]);
 							// $this->addError([" {$display} already exists. Please choose another {$display}.", $item]);
 						}
 					 
 						break;

 				case 'is_numeric':
 						# code...
 						if(!is_numeric($value))
 							{
 								$this->addError([" {$display} has to be a number.", $item]);
 							}
 							break;

 				case 'valid_email':
 					# code...
 					if(!filter_var($value, FILTER_VALIDATE_EMAIL))
 					{
 						$this->addError(["{$display} must be a valid email address.", $item]);
 					}
 					break;
 				default:
 					# code...
 					break;
 			}
 		}
 	  }

 }
 if(empty($this->_errors))
 	{
		$this->_passed = true;
	}
	return $this;

}


 
public function addError($error)
{

	$this->_errors[] = $error;
	if(empty($this->_errors))
	{
		$this->_passed = true;
	} else {
		$this->_passed = false;
	}
}


public function errors()
{
	return $this->_errors;
}


public function passed()
{
	return $this->_passed;
}


public function displayErrors()
{
$html = '<ul class="bg-warning">';
		
		foreach ($this->_errors as $error)
		 {
		 	if(is_array($error))
		 	{
$html .= '<li class="text-danger">'.$error[0].'</li>';
		$html .= '<script>jQuery("document").ready(function(){ jQuery("#'.$error[1].'").parent().closest("div").addClass("has-error");});</script>';
		 	}
			 else{
			 	$html .= '<li class="text-primary">'.$error.'</li>';
			 }
		
		 }

		 $html .= '</ul>';

		 return $html;
}




}