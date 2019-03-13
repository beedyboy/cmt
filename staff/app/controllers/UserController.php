<?php
/**
* 
*/
class UserController extends Controller
{
	
	function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		$this->load_model('User');
		  
		 if(!Auth::check()): Router::redirect('login'); endif;
		  
	}


public function index()
{
	 	$this->view->displayErrors = $this->validate->displayErrors(); 
		$this->view->render('client/index'); 
		$this->view->extra('layouts/beedy_kaydee');  
}



public function list()
{
 
	 $data  = $this->User->paginate(PAGE_LIMIT);
 	$x = 1;
   foreach ($data as $User)
  {
                    # code...
                 ?>

<tr> 
<td><?=$x;?></td>
<td><?php echo $User->acc_first_name; ?> </td> 
<td><?php echo $User->acc_last_name; ?> </td> 
<td><?php echo $User->acc_phone; ?> </td>    
<td><?php echo $User->acc_email; ?> </td>    
<td><?php echo $User->gender; ?> </td>    
<td><?php echo $User->created_at; ?> </td> 
<td><?php echo $User->updated_at; ?> </td> 

<td> 
 
<button type="button" name="modUser" id="<?php echo $User->id; ?>" class="btn btn-primary btn-xs modUser">
	<i class="icon_check_alt2"></i> Edit</button>
 
	</td>
 		 
	<td>
	 
	  <button type="button" name="delUser" id="<?php echo $User->id; ?>" class="btn btn-danger btn-xs delUser">
	<i class="icon_close_alt2"></i> Delete</button> 
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
	 $this->view->displayErrors = $this->validate->displayErrors();
		$this->view->extra('client/create');
}
 #endregion

 public function store()
 {

        $data = array();
        $validation = new validate(); 

                    if($_POST)
                    {
                       

                        $validation->check($_POST, [

                                            'acc_first_name'=> [
                                            'display'=> 'First Name',
                                            'max' => 30,
                                            'required'=> true
                                                ],

                                            'acc_last_name'=> [
                                            'display'=> 'Last Name',
                                            'max' => 30,
                                            'required'=> true
                                            ],
  
                                            'acc_email'=> [
                                            'display'=> 'Email',
                                            'unique'=> 'users',
                                            'required'=> true, 
                                            'max' => 50,
                                            'valid_email' => true
                                            ],

                                            'acc_phone'=> [
                                            'display'=> 'Phone Number',
                                            'required'=> true, 
                                            'max'=> 20
																						],
																						
                                            'acc_password'=> [
                                            'display'=> 'Password',
                                            'required'=> true, 
                                            'min'=> 6
                                            ],

                                            'confirm'=> [
                                            'display'=> 'Confirm Password',
                                            'required'=> true,  
                                            'matches' => 'acc_password'
                                            ] 
                                                                        ]);


                if($validation->passed())
                {
									
									$fields = [										 
										 	 
										'acc_first_name' => Input::get('acc_first_name'),	 	 
										'acc_last_name' => Input::get('acc_last_name'),  
										'acc_email' => Input::get('acc_email'),	 	 
										'gender' => Input::get('gender'),  
										'acc_phone' => Input::get('acc_phone'),  	 
										'acc_password' => password_hash(Input::get('acc_password'), PASSWORD_DEFAULT),  
										'created_at' => '',		  	 
										'updated_at' => '',		 	 
							];	
 
				  
						$send = $this->User->insert($fields);

							if($send):
							
								$data['status'] = "success";
								$data['msg']  =   'New User has been added successfully';
		 
							else:
							
								$data['status'] = "db_error";
								$data['msg'] = "Error: User was not added. Please try again later";
							endif;
								}
								else
								{
									$data['status'] = "error";
                $data['msg'] = $validation->displayErrors();
								}

                unset($_POST);
                echo json_encode($data);

                     } 

										
									}


/**
 * [edit function]
 * @param  [type] $id [primary key to be edited]
 * @return [type]     [view]
 */
public function edit($id)
{		
	$this->view->data = $this->User->findById($id);
	 $this->view->displayErrors = $this->validate->displayErrors();
		$this->view->extra('client/edit');
}

    public function update()
    {
       if($_POST)
        {
            
					$data = array();
					$validation = new validate(); 
 
										$validation->check($_POST, [

																							'acc_first_name'=> [
																							'display'=> 'First Name',
																							'max' => 30,
																							'required'=> true
																									],

																							'acc_last_name'=> [
																							'display'=> 'Last Name',
																							'max' => 30,
																							'required'=> true
																							],

																							'acc_email'=> [
																							'display'=> 'Email', 
																							'required'=> true, 
																							'max' => 50,
																							'valid_email' => true
																							],

																							'acc_phone'=> [
																							'display'=> 'Phone Number',
																							'required'=> true, 
																							'max'=> 20
																							],
																							
																						 
																					]);


								if($validation->passed())
								{

									$fields = [										 

									'acc_first_name' => Input::get('acc_first_name'),	 	 
									'acc_last_name' => Input::get('acc_last_name'),  
									'acc_email' => Input::get('acc_email'),	 	 
									'gender' => Input::get('gender'),  
									'acc_phone' => Input::get('acc_phone'),  
									'updated_at' => ''       
													];  
								
					 				 $ary = [];      
										$params = [  'conditions'=> ['id <> ? '], 'bind' => [Input::get('id')] ];    

										$existing = $this->User->find($params);  
							    	$User = $this->User->findById((int)Input::get('id'));
									 							
										foreach ($existing as $key => $value)
										 {
												$ary[] = $value->acc_email;
										 }
											
								
								if($User->acc_first_name != Input::get('acc_first_name') || $User->gender != Input::get('gender') || $User->acc_email != Input::get('acc_email') || $User->acc_last_name != Input::get('acc_last_name')):

										if(!in_array( Input::get('acc_email'), $ary)):
												$send = $this->User->update($fields, (int)Input::get('id'));
												
												if($send):   
														$data['status'] = "success";
														$data['msg']  =   'User record updated successfully';    
												else:
												$data['status'] = "db_error";
												$data['msg'] = "Error: User was not updated. Please try again later"; 
												endif;

										else:
														$data['status'] = "error";
														$data['msg'] = "Error: This User email may already exist. Please try again with a different one";
										endif;
								endif;		
						 	}
							else
							{
									$data['status'] = "val_error";
									$data['msg'] = $validation->displayErrors();
							}
									

								unset($_POST);
								echo json_encode($data);        
								
	  }   
  }
 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return User
     * 
     */
    public function destroy($id)
    {
       $del = $this->User->delete($id); 
      if($del): echo "User Deleted Successfully"; else: "Error deleting this data... Please try again later"; endif;
	

    }


}