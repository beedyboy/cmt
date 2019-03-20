<?php
/**
* 
*/
class ActivityController extends Controller
{
	
	function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		$this->load_model('Activity');
		  
		if(!Auth::check()): Router::redirect('login'); endif;
		  
	}


public function index()
{
	 $this->view->displayErrors = $this->validate->displayErrors(); 
		$this->view->render('product/index'); 
		$this->view->extra('layouts/beedy_kaydee');  
}


public function create()
{ 
 
	 $this->view->displayErrors = $this->validate->displayErrors();
		$this->view->extra('product/create');
}
 

/**
 * Project activities
 * 
 */

public function projectActivity($projectId)
{ 
	$Admin = new Admin('admins'); 
	$Product = new Product('products'); 
	$Project = new Project('projects'); 
	 $data  = $this->Activity->paginate(PAGE_LIMIT,['conditions'=> ['projectId = ?'], 'bind' => [(int)$projectId] ]);
 	$x = 1;
   foreach ($data as $Activity)
  {
             
  ?> 
<tr> 
<td><?=$x;?></td> 

<td><?php echo $Activity->subject; ?> </td>
<td><?php echo $Activity->comment; ?> </td> 
<td><?php echo '<img src="data:image;base64,'.$Product->findById($Activity->productId)->media.'" class="pimage" width="100" height="60" />' ?> </td> 
<td>
<?php 
 $manager =  $Admin->findById($Activity->staffId); 
		echo $manager->firstname. " ".$manager->lastname;?> 
</td> 
<td><?php echo $Activity->created_at; ?> </td>   

<td> 
<button type="button" name="agreePrice" id="<?php echo $Activity->id; ?>" class="btn btn-primary btn-xs agreePrice">
	<i class="fas fa-pencil-alt fa-fw"></i> View</button>
</td>

	 
</tr>
 
<?php 
$x++; 
 } 
  ?> 
  <tr><td colspan="4"><?=pageLinks();?></td></tr>
  <?php
}

 


}