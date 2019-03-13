<?php
/**
* 
*/
class ProductController extends Controller
{
	
	function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		$this->load_model('Product');
		  
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

public function list()
{
 
	 $data  = $this->Product->paginate(PAGE_LIMIT);
 	$x = 1;
   foreach ($data as $product)
  {
     $Product = new Product('products'); 
                # code...
   ?>

<tr> 
<td><?=$x;?></td>
<td><?php echo $product->product_name; ?> </td> 
 
<td><?php echo '<img src="data:image;base64,'.$product->image.'" class="pimage" width="100" height="60" />' ?> </td> 
<td><?php echo $product->product_description; ?> </td>  
<td><?php echo $product->created_at; ?> </td> 
<td><?php echo $product->updated_at; ?> </td> 

<td> 
 
<button type="button" name="modProduct" id="<?php echo $product->id; ?>" class="btn btn-primary btn-xs modProduct">
	<i class="icon_check_alt2"></i> Edit</button>
 
	</td>
 		 
	<td>
	 
	  <button type="button" name="delProduct" id="<?php echo $product->id; ?>" class="btn btn-danger btn-xs delProduct">
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


public function store()
{
  
 
		if($_POST)
		{
			$data = array();
 
			$this->validate->check($_POST, [ 
									 
										'pname'=> [
													'display'=> 'Product Name',
													'required'=> true,   
												] 
										]);
		  
		   if($this->validate->passed())
				{
						 $image = addslashes($_FILES['photo']['tmp_name']);
					    $i_name = addslashes($_FILES['photo']['name']);
					    $image = file_get_contents($image);
					    $image = base64_encode($image);


						  	$fields = [										 
										 	 
										'product_name' => Input::get('pname'),	 	 
										'product_description' => Input::get('prd_desc'), 
										'i_name' => $i_name,	 	 
										'image' => $image,	 	 
										'created_at' => '',		  	 
										'updated_at' => '',		 	 
							];	
 
				  
						$send = $this->Product->insert($fields);
						
						if($send): 
							//Session::flash('success', 'New Product has been added successfully');
						  	$data['status'] = "success";
							$data['msg']  =   'New Product has been added successfully';
   
				  		else:
				  		$data['status'] = "db_error";
							$data['msg'] = "Error: Product was not added. Please try again later";
				 			

				  		endif;
				}
				else{
					$data['status'] = "error";
						$data['msg'] = $this->validate->displayErrors();
				}
					 

				unset($_POST);
				echo json_encode($data);  		
 
		}	
 //store ends down here
}


/**
 * [edit function]
 * @param  [type] $id [primary key to be edited]
 * @return [type]     [view]
 */
public function edit($id)
{		
	$this->view->data = $this->Product->findById($id);
	 $this->view->displayErrors = $this->validate->displayErrors();
		$this->view->extra('product/edit');
}


public function update()
{
  
		if($_POST)
		{
			$data = array(); 
			$this->validate->check($_POST, [  'pname'=> [
													'display'=> 'Product Name',
													'required'=> true,
													'max' => 30
												]
										]);
		  
		   if($this->validate->passed())
		   {
		   		$Product = $this->Product->findById(Input::get('id'));
		   		
		   		if($Product->product_name != Input::get('pname'))
		   		{ 
		   			
		   			//compute the fields
		   			$fields = ['product_name' => Input::get('pname'), 'product_description' => Input::get('prd_desc'),  'updated_at' => '' ];	
		   			//update the db
		   			$send = $this->Product->update($fields, (int)Input::get('id'));
		   			//check if updated
		   			if($send)
		   			{
							$data['status'] = "success";
							$data['msg']  =   'Product has been updated successfully';
   				  
		   			}
		   			else
		   			{
		   				$data['status'] = "db_error";
		   				$data['msg'] = "Error: Product was not saved. Please try again later";
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
 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Product
     * 
     */
    public function destroy($id)
    {
       $del = $this->Product->delete($id); 
      if($del): echo "Product Deleted Successfully"; else: "Error deleting this data... Please try again later"; endif;
	

    }


}