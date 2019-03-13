
<?php

$crud = 'read';

$db= DB::getInstance();
	$out = array('error' => false);


if(isset($_GET['crud'])){
	$crud = $_GET['crud'];
}


if($crud == 'read')
{


	 $Feature = $db->find('features');

  	$out['Feature'] = $Feature;

 

}

header("Content-type: application/json");
echo json_encode($out);
die();

?>