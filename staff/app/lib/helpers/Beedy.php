<?php
/**
* 
*/
class Beedy
{
	protected $_Software, $_Setting, $_User, $_ary=[];
	function __construct()
	{
		 
/*$org_id = Auth::auth('org_id'); 
$newSystem = new Software('softwares');
$this->_Software = $newSystem->findById($org_id); 
*/
 
/*
 $newSetting = new Setting('Settings');

$setArray = [ 'conditions'=> 'org_id = ?', 'bind' => [$org_id]  ];
$this->_Setting = $newSetting->findWhere('settings',$setArray);*/
// $this->_Setting = $newSetting->findWhere('settings',['conditions'=> 'org_id = ?', 'bind' => [$org_id] ]);


/*$User = new User('users'); 
$ary = [ 'conditions'=> 'org_id = ?', 'bind' => [$org_id]  ];

 		$this->_ary= $ary;
 		$this->_User = $User->findWhere('users', $ary); 
	*/
	}

public  function getCompanyId()
{
	return  $org_id = Auth::auth('org_id'); 
 
}
 
public  function getCompanySetting()
{
	return  $this->_Setting;
 
}

 

public  function getCompany()
{
	return  $this->_Software->org_name;
 
}

 

 
public  function TotalCount()
{
	return $this->_Software->count();
}


public function totalUser()
{
  
// return  $this->_User->count();
// return count( $this->_User);
}
  
public function totalEvent()
{
  $Event = new Event('events');
 $total = $Event->findWhere('events',$this->_ary);
return count( $total);
}
  

public function totalRole()
{
  $Role = new Role('roles');
 $total = $Role->findWhere('roles',$this->_ary);
return count( $total);
}
  


public function totalCategory()
{
  $Category = new Category('categories');
 $total = $Category->findWhere('categories',$this->_ary);
return count( $total);
}
  



}

/*
DELIMITER $$
CREATE TRIGGER `spyTrigger` 
BEFORE UPDATE ON `payments` FOR EACH ROW
BEGIN 
    INSERT INTO log (pay_by, amount, phone) 
    VALUES (NEW.pay_by, NEW.amount, NEW.phone );
END;

$$

 
 */



/*
BEGIN 
    INSERT INTO log (pay_by, amount, phone) 
    VALUES (OLD.pay_by, OLD.amount, OLD.phone );
END
 */