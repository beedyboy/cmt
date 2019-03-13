<?php
/**
* 
*/
class AdminController extends Controller 
{
	
	public function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
        $this->load_model('Admin'); 
        Auth::isLoggedIn();

	}
 

    /**
     * Display a listing of the resource.
     *
     * @return \Router\View
     */
    
public function sms()
{
 
 
        $this->view->render('Admin/sms');   
}
 
public function index()
{
 
 
        $this->view->displayErrors = $this->validate->displayErrors();
        $this->view->data  = $this->Admin->find();
        $this->view->render('admin/index'); 
        $this->view->extra('layouts/beedy_kaydee');  
}


public function list()
{
 
    $Role = new Role('roles'); 
     $data  = $this->Admin->paginate(PAGE_LIMIT );
    $x = 1;
   foreach ($data as $Admin)
  {
             
  ?>

<tr> 
<td>
 <input type="checkbox" name="AdminCheck[]" value="<?=$Admin->id?>" class="AdminCheckCase">  
 </td>
 
<td><?php echo $Admin->firstname; ?> </td>  
<td><?php echo $Admin->lastname; ?> </td> 
<td><?php echo $Role->findById($Admin->role)->name; ?> </td> 
<td><?php echo $Admin->email; ?> </td>    
<td><?php echo $Admin->gender; ?> </td>     
<td><?php echo $Admin->created_at; ?> </td> 
<td><?php echo $Admin->updated_at; ?> </td>  

<td> 
 
<button type="button" name="modAdmin" id="<?php echo $Admin->id; ?>" class="btn btn-success btn-xs modAdmin">
    <i class="icon_check_alt2"></i> Edit</button>
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
    $Role = new Role('roles');
    $this->view->Role = $Role->find();
     $this->view->displayErrors = $this->validate->displayErrors();
        $this->view->extra('admin/create');
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

                                            'lastname'=> [
                                            'display'=> 'Last Name',
                                            'max' => 30,
                                            'required'=> true
                                            ],
  
                                            'role'=> [
                                            'display'=> 'Roles', 
                                            'required'=> true
                                            ],
  
                                            'email'=> [
                                            'display'=> 'Email',
                                            'unique'=> 'admins',
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
                  
                    $newAdmin = new Admin('Admin');
                    $newAdmin->registerNewUser($_POST);

                    $data['status'] = "success";
                            $data['msg']  =   'New Admin has been added successfully';
                 
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
      
    $Role = new Role('roles');
    $this->view->Role = $Role->find();   
    $this->view->data = $this->Admin->findById($id);
     $this->view->displayErrors = $this->validate->displayErrors(); 
        $this->view->extra('admin/edit');
}

public function profile()
{       
      
    $this->view->data = $this->Admin->findById(getAdminId());
    $this->view->displayErrors = $this->validate->displayErrors(); 
    $this->view->render('admin/profile');
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

                                            'lastname'=> [
                                            'display'=> 'Last Name',
                                            'required'=> true
                                            ],
 
                                            'role'=> [
                                            'display'=> 'Role',
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
                                        'lastname' => Input::get('lastname'),                                    
                                        'email' => Input::get('email'),                                    
                                        'role' => Input::get('role'),                                    
                                        'gender' => Input::get('gender'),  
                                        'updated_at' => ''       
                            ];  
 
            $ary = [];      
    $params = [  'conditions'=> ['id <> ? '], 'bind' => [Input::get('id')] ];    

    $existing = $this->Admin->find($params);  
                $Admin = $this->Admin->findById((int)Input::get('id'));
                 
                
            foreach ($existing as $key => $value) {
                $ary[] = $value->email;
            }
       
 
 if($Admin->firstname != Input::get('firstname') || $Admin->role != Input::get('role') || $Admin->email != Input::get('email') || $Admin->lastname != Input::get('lastname')):

                    if(!in_array( Input::get('acc_email'), $ary)):
                        $send = $this->Admin->update($fields, (int)Input::get('id'));
                        
                        if($send):  
                           
                            $data['status'] = "success";
                            $data['msg']  =   'Admin record updated successfully';    
                        else:
                        $data['status'] = "db_error";
                        $data['msg'] = "Error: Admin was not updated. Please try again later"; 
                        endif;

                    else:
                            $data['status'] = "error";
                            $data['msg'] = "Error: This Admin email may already exist. Please try again with a different one";
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
      
    $this->view->data = $this->Admin->findById(getAdminId());
    $this->view->displayErrors = $this->validate->displayErrors(); 
    $this->view->extra('Admin/updatePassword');
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
  
                        $send = $this->Admin->update($fields, (int)Input::get('id')); 
                     
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
      
    $this->view->data = $this->Admin->findById(getAdminId());
    $this->view->displayErrors = $this->validate->displayErrors(); 
    $this->view->extra('Admin/recovery');
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
 
          
                $Admin = $this->Admin->findById(getAdminId());
                 
              if($Admin->acc_question != Input::get('acc_question') || $Admin->acc_answer != Input::get('acc_answer')):
                     
                        $send = $this->Admin->update($fields, (int)Input::get('id')); 
                     
                          if($send):  
                           
                            $data['status'] = "success";
                            $data['msg']  =   'Admin updated successfully';    
                        else:
                            $data['status'] = "db_error";
                            $data['msg'] = "Error: Admin was not updated. Please try again later"; 
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

