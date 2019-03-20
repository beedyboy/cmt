<?php
/**
* 
*/
class ProjectController extends Controller
{ 

	public function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		
		Auth::isLoggedIn();
		
		$this->load_model('Project');

		$this->view->setLayout('app'); 
	}
 
	
	 
 
public function index()
{
 
	$this->view->displayErrors = $this->validate->displayErrors(); 
	$this->view->render('project/index'); 
	$this->view->extra('layouts/beedy_kaydee');   
}

public function activeProject()
{
	// $Admin = new Admin('admins'); 
	// $User = new User('users'); 
	$Product = new Product('products');  

	  $data  = $this->Project->paginate(PAGE_LIMIT,[
		  'conditions'=>
	  ['userId = ?', ' projectStatus = ? '], 
	  'bind' => [(int)$this->user_id, 'Active'] ]);
 	$x = 1;
   foreach ($data as $ActiveProject)
  {
             
  ?> 
<tr> 
<td><?=$x;?></td>
<td><?php echo $Product->findById($ActiveProject->productId)->product_name; ?> </td> 
<td><?php echo '<img src="data:image;base64,'.$Product->findById($ActiveProject->productId)->image.'" class="pimage" width="100" height="60" />' ?> </td>  
<td><?php echo $ActiveProject->negotiatedAmount; ?> </td>  
<!-- <td>
<?php //$user =  $User->findById($ActiveProject->staffId); 
		//echo $user->acc_first_name. " ".$user->acc_last_name;?> 
</td>  -->
<!-- <td>
<?php // $manager =  $Admin->findById($ActiveProject->staffId); 
	//	echo $manager->firstname. " ".$manager->lastname;?> 
</td>  -->
<td><?php echo $ActiveProject->created_at; ?> </td> 
<td><?php echo $ActiveProject->updated_at; ?> </td> 
<td> 
<a  href="<?=base_url.'project/show/'.$ActiveProject->id?>"   class="btn btn-primary btn-xs ">
	<i class="fas fa-pencil-alt fa-fw"></i> View</button>
 
<!-- <button type="button" name="viewActiveProject" part='list' id="<?php echo $ActiveProject->id; ?>" class="btn btn-primary btn-xs viewActiveProject">
	<i class="fas fa-pencil-alt fa-fw"></i> View</button> -->
</td>

	 
</tr>
 
<?php 
$x++; 
 } 
  ?> 
  <tr><td colspan="4"><?=pageLinks();?></td></tr>
  <?php
}

public function pendingProject()
{
	 
	$Product = new Product('products');  
	 $data  = $this->Project->paginate(PAGE_LIMIT,['conditions'=> ['userId = ?', ' projectStatus = ?'], 'bind' => [(int)$this->user_id, 'Pending'] ]);
 	$x = 1;
   foreach ($data as $pendingProject)
  {
             
  ?> 
<tr> 
<td><?=$x;?></td>
<td><?php echo $Product->findById($pendingProject->productId)->product_name; ?> </td>  

<td><?php echo '<img src="data:image;base64,'.$Product->findById($pendingProject->productId)->image.'" class="pimage" width="100" height="60" />' ?> </td>  
<!-- <td><?php echo $pendingProject->projectStatus; ?> </td>  -->
<td><?php echo $pendingProject->created_at; ?> </td> 
<td><?php echo $pendingProject->updated_at; ?> </td>  
</tr>
 
<?php 
$x++; 
 } 
  ?> 
  <tr><td colspan="4"><?=pageLinks();?></td></tr>
  <?php
}

public function negotiatingProject()
{ 
	$Admin = new Admin('admins'); 
	$Product = new Product('products'); 
	$Project = new Project('projects'); 
	 $data  = $this->Project->paginate(PAGE_LIMIT,['conditions'=> ['userId = ?', ' projectStatus = ?'], 'bind' => [(int)$this->user_id,'Negotiating'] ]);
 	$x = 1;
   foreach ($data as $NegotiatingProject)
  {
             
  ?> 
<tr> 
<td><?=$x;?></td>
<td><?php echo $Product->findById($NegotiatingProject->productId)->product_name; ?> </td>  
<td><?php echo '<img src="data:image;base64,'.$Product->findById($NegotiatingProject->productId)->image.'" class="pimage" width="100" height="60" />' ?> </td>  


<td><?php echo $NegotiatingProject->negotiatedAmount; ?> </td>
<!-- <td><?php echo $NegotiatingProject->projectStatus; ?> </td>  -->
<td><?php echo $NegotiatingProject->created_at; ?> </td>  
<td><?php echo $NegotiatingProject->updated_at; ?> </td> 
<td>
<?php
// echo $NegotiatingProject->updated_by;
 $manager =  $Admin->findById($NegotiatingProject->updated_by); 
		echo $manager->firstname. " ".$manager->lastname;?> 
</td> 
<td> 
<button type="button" name="agreePrice" id="<?php echo $NegotiatingProject->id; ?>" class="btn btn-primary btn-xs agreePrice">
	<i class="fas fa-pencil-alt fa-fw"></i> Sets Active</button>
</td>

	 
</tr>
 
<?php 
$x++; 
 } 
  ?> 
  <tr><td colspan="4"><?=pageLinks();?></td></tr>
  <?php
}


 
public function create()
{ 
	 $User = new User('users');
  	 $this->view->User = $User->find(); 

	 $Product = new Product('products');
  	 $this->view->Product = $Product->find(); 
	 $this->view->displayErrors = $this->validate->displayErrors();
	 $this->view->extra('project/create');
}
 

public function agreePrice($id)
{
  
		 
			$data = array(); 
			  
		   		$fields = [ 'projectStatus'=>'Active' ];	
		   			//update the db
		   			$send = $this->Project->update($fields, (int)$id );
					 
		   			//check if updated
		   			if($send)
		   			{
							$data['status'] = "success";
							$data['msg']  =   'Project now active';
   				  
		   			}
		   			else
		   			{
		   				$data['status'] = "db_error";
		   				$data['msg'] = "Error:  Please try again later";
		   			}
		   		 
		   echo json_encode($data);  
 					
 	 
 //update ends down here
}

 

/**
 * [edit function]
 * @param  [type] $id [primary key to be edited]
 * @return [type]     [view]
 */ 
public function update()
{
  
		if($_POST)
		{
			$data = array(); 
			$this->validate->check($_POST, [  'name'=> [
													'display'=> 'Project\'s Name',
													'required'=> true,
													'max' => 20
												],

			 								   'description'=> [
													'display'=> 'Description Name', 
													'max' => 100
												]
										]);
		  
		   if($this->validate->passed())
		   {
		   		$Project = $this->Project->findById(Input::get('id'));
		   		
		   		if($Project->name = Input::get('name'))
		   		{ 
		   			
		   			//compute the fields
		   			$fields = ['name' => Input::get('name'),  'description' => Input::get('description'),  'updated_at' => '' ];	
		   			//update the db
		   			$send = $this->Project->update($fields, (int)Input::get('id'));
		   			//check if updated
		   			if($send)
		   			{
							$data['status'] = "success";
							$data['msg']  =   'Project has been updated successfully';
   				  
		   			}
		   			else
		   			{
		   				$data['status'] = "db_error";
		   				$data['msg'] = "Error: Project was not saved. Please try again later";
		   			}
		   		}
			 
					unset($_POST);
				 
		   }
		   else
		   {
					 	$data['status'] = "error";
						$data['msg'] = $this->validate->displayErrors();
		   }
		   echo json_encode($data);  
 					
 		}
	 
 //update ends down here
}
 
public function store()
{
$validation = new validate();
$db = DB::getInstance();
$data = array(); 
if($_POST)
{
  
  	$fields = [										 
'userId' => $_POST['client_id'],									 
'productId' => $_POST['product_id']	,	 
'created_at' => '',		  	 
'updated_at' => '',		 
	];	
	$validation->check($_POST, [

											'product_id'=> [
											'display'=> 'Product field',
											'required'=> true
												],

											'client_id'=> [
											'display'=> 'Client field',
											'required'=> true
											]
								]);
	if($validation->passed())
				{
				$send = $this->Project->insert($fields);


				if($send): 
					// Session::flash('success', 'New Product has been added successfully');
					  $data['status'] = "success";
					$data['msg']  =   'New Project has been created successfully';

				  else:
				  $data['status'] = "db_error";
					$data['msg'] = "Error: Project was not created. Please try again later";
					 

				  endif;
		}
		else{
			$data['status'] = "error";
				$data['msg'] = $this->validate->displayErrors();
		}
			 

		unset($_POST);
		echo json_encode($data);  		

}	



}



public function show($id)
{ 

		$this->view->displayErrors = $this->validate->displayErrors(); 	
	  	$this->view->data  = $this->Project->findById($id);
	  	$this->view->projectList  = $this->projectList();
		$this->view->render('project/show'); 
		$this->view->extra('layouts/beedy_kaydee');  
}

public function projectList()
{
	  

	$data  = $this->Project->paginate(PAGE_LIMIT,[ 'conditions'=> ['userId = ?', ' projectStatus = ? '],  'bind' => [(int)$this->user_id, 'Active'] ]);
	return $data;
}
 

//end class
}