<?php
/**
* 
*/
class UserController extends Controller 
{
	
	public function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		$this->load_model('User'); 

	}
 

    /**
     * Display a listing of the resource.
     *
     * @return \Router\View
     */
    
public function sms()
{
 
 
        $this->view->render('user/sms');   
}
 
public function index()
{
 
 
        $this->view->displayErrors = $this->validate->displayErrors();
        $this->view->data  = $this->User->find();
        $this->view->render('user/index'); 
        $this->view->extra('layouts/beedy_kaydee');  
}


public function list()
{
 
    // $Role = new Role('roles'); 
     $data  = $this->User->paginate(PAGE_LIMIT );
    $x = 1;
   foreach ($data as $User)
  {
             
  ?>

<tr> 
<td>
 <input type="checkbox" name="UserCheck[]" value="<?=$User->id?>" class="UserCheckCase">  
 </td>
 
<td><?php echo $User->firstname; ?> </td>  
<td><?php echo $User->othernames; ?> </td>   
<td><?php echo $User->phone; ?> </td>   
<td><?php echo $User->email; ?> </td>    
<td><?php echo $User->created_at; ?> </td> 
<td><?php echo $User->updated_at; ?> </td>  

<td> 
 
<button type="button" name="modUser" id="<?php echo $User->id; ?>" class="btn btn-primary btn-xs modUser">
    <i class="fas fa-pencil-alt fa-fw"></i> Edit</button>
   </td>

    
</tr>
 
<?php 
$x++; 
 } 
  ?> 
  <tr><td colspan="3"><?=pageLinks();?></td></tr>
  <?php
}

public function create()
{
    
     $this->view->displayErrors = $this->validate->displayErrors();
        $this->view->extra('User/create');
}


 public function store()
 {

        $data = array();
        $validation = new validate(); 

                    if($_POST)
                    {
                       

                        $validation->check($_POST, [

                                            'firstname'=> [
                                            'display'=> 'First Name',
                                            'max' => 30,
                                            'required'=> true
                                                ],

                                            'othernames'=> [
                                            'display'=> 'Other Names',
                                            'max' => 50,
                                            'required'=> true
                                            ],
 

                                            'username'=> [
                                            'display'=> 'Username',
                                            'unique'=> 'Users', 
                                            'max' => 50 
                                            ],

                                            'email'=> [
                                            'display'=> 'Email',
                                            'unique'=> 'Users',
                                            'required'=> true, 
                                            'max' => 50,
                                            'valid_email' => true
                                            ],

                                            'password'=> [
                                            'display'=> 'Password',
                                            'required'=> true, 
                                            'min'=> 6
                                            ],

                                            'confirm'=> [
                                            'display'=> 'Confirm Password',
                                            'required'=> true,  
                                            'matches' => 'password'
                                            ] 
                                                                        ]);


                if($validation->passed())
                {
                  
                    $newUser = new User('User');
                    $newUser->registerNewUser($_POST);

                    $data['status'] = "success";
                            $data['msg']  =   'New User has been added successfully';
                 
                }
                  else{
                      $data['status'] = "error";
                        $data['msg'] = $validation->displayErrors();
                    } 


                unset($_POST);
                echo json_encode($data);

                     } 

 }

 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $system = System::find($id);
        return view('system.show')->withSystem($system);
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
        $this->view->extra('User/edit');
}

public function profile()
{       
      
    $this->view->data = $this->User->findById(getUserId());
    $this->view->displayErrors = $this->validate->displayErrors(); 
    $this->view->render('User/profile');
        $this->view->extra('layouts/beedy_kaydee');  
}


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
       if($_POST)
        {
            
            $data = array();
 
            $this->validate->check($_POST, [ 
                                        'firstname'=> [
                                            'display'=> 'First Name',
                                            'required'=> true
                                                ],

                                            'othernames'=> [
                                            'display'=> 'Other Names',
                                            'required'=> true
                                            ],
 

                                            'email'=> [
                                            'display'=> 'Email',
                                            'required'=> true, 
                                            'max' => 50,
                                            'valid_email' => true
                                            ] 
                                                 
                                        ]);
          
           if($this->validate->passed())
                {
                     
                            $fields = [                                      
                                        'firstname' => Input::get('firstname'),                                    
                                        'othernames' => Input::get('othernames'),                                    
                                        'email' => Input::get('email'),                                    
                                        'phone' => Input::get('phone'),  
                                        'updated_at' => ''       
                            ];  
 
            $ary = [];      
    $params = [  'conditions'=> ['org_id = ? ', 'id <> ? '], 'bind' => [$this->org_id, Input::get('id')] ];    

    $existing = $this->User->find($params);  
                $User = $this->User->findById((int)Input::get('id'));
                 
                
            foreach ($existing as $key => $value) {
                $ary[] = $value->email;
            }
       
 
 if($User->firstname != Input::get('firstname') || $User->acc_last_name != Input::get('acc_last_name') || $User->email != Input::get('email') || $User->phone != Input::get('phone')):

                    if(!in_array( Input::get('email'), $ary)):
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
                            $data['msg'] = "Error: This User email may already exist. Please try again with a concrete description";
                    endif;
                         
  endif;
                }
                else
                {
                    $data['status'] = "error";
                        $data['msg'] = $this->validate->displayErrors();
                }
                     

                unset($_POST);
                echo json_encode($data);        
 
        }   
    }
  /**
   * [accPassword description]
   * @return [type] [description]
   */
public function accPassword()
{      
      
    $this->view->data = $this->User->findById(getUserId());
    $this->view->displayErrors = $this->validate->displayErrors(); 
    $this->view->extra('User/updatePassword');
}


 public function updatePassword()
    {
       if($_POST)
        {
            
            $data = array();
 
            $this->validate->check($_POST, [ 
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
          
           if($this->validate->passed())
            {
                     
                $fields = ['acc_password' => password_hash(Input::get('acc_password'), PASSWORD_DEFAULT), 'acc_password_box' => Input::get('acc_password'),'updated_at' => ''];  
  
                        $send = $this->User->update($fields, (int)Input::get('id')); 
                     
                          if($send):  
                           
                            $data['status'] = "success";
                            $data['msg']  =   'Password updated successfully';    
                        else:
                            $data['status'] = "db_error";
                            $data['msg'] = "Error: Password was not updated. Please try again later"; 
                        endif;
    
            }
            else
            {
                    $data['status'] = "error";
                    $data['msg'] = $this->validate->displayErrors();
             }
                     

                unset($_POST);
                echo json_encode($data);        
 
        }   
    }
    /**
     * [recovery description]
     * @return [type] [description]
     */
public function recovery()
{      
      
    $this->view->data = $this->User->findById(getUserId());
    $this->view->displayErrors = $this->validate->displayErrors(); 
    $this->view->extra('User/recovery');
}
     
    public function saveRecovery()
    {
       if($_POST)
        {
            
            $data = array();
 
            $this->validate->check($_POST, [ 
                                            'acc_question'=> [
                                            'display'=> 'Recovery Question',
                                            'required'=> true,
                                            'max'=> 30
                                                ],

                                            'acc_answer'=> [
                                            'display'=> 'Recovery Answer',
                                            'required'=> true,
                                            'max'=> 30
                                            ] 
                                                 
                                        ]);
          
           if($this->validate->passed())
            {
                     
            $fields = ['acc_question' => Input::get('acc_question'), 'acc_answer' => Input::get('acc_answer'),'updated_at' => ''      ];  
 
          
                $User = $this->User->findById(getUserId());
                 
              if($User->acc_question != Input::get('acc_question') || $User->acc_answer != Input::get('acc_answer')):
                     
                        $send = $this->User->update($fields, (int)Input::get('id')); 
                     
                          if($send):  
                           
                            $data['status'] = "success";
                            $data['msg']  =   'User updated successfully';    
                        else:
                            $data['status'] = "db_error";
                            $data['msg'] = "Error: User was not updated. Please try again later"; 
                        endif;


                endif;
                    
            }
           else
            {
                    $data['status'] = "error";
                    $data['msg'] = $this->validate->displayErrors();
             }
                     

                unset($_POST);
                echo json_encode($data);        
 
        }   
    }
   
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $system = System::find($id);

       $system->delete(); 
       Session::flash('success', 'System deleted successsfully');
       
       //redirect to index

       return redirect()->route('system.index');

    }


  
  //ends
} 

