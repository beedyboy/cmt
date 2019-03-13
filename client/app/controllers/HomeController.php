<?php
/**
* 
*/
class HomeController extends Controller
{
	
	public function __construct($controller, $action)
	{
	
		# code...
		parent::__construct($controller, $action);
		 
		$this->view->setLayout('app');

 		Auth::isLoggedIn();
	}

public function index()
{  
	// echo "This is home page";
	 $this->view->render("home/index");
	/* $db = DB::getInstance(); 
 	$Event = new Event('events');
 	$org_id =(int)$this->org_id;
 	$params = [	 'conditions'=> ['org_id = ?'],	 'bind' => [$this->org_id], 'order'=>'id DESC', 'limit'=>5  ];	
 	 $this->view->displayErrors = $this->validate->displayErrors();
	 $this->view->data  = $Event->find($params);

 	$event = $db->query("SELECT DISTINCT cat_id FROM events WHERE org_id = $org_id");
 	$this->view->event = $db->results();
 $this->view->render("home/index");*/
}

public function dashboard(){
	$this->view->render("home/dashboard");

}
}