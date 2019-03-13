<?php
/**
* 
*/
class SoftwareController extends Controller 
{
	
	public function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		$this->load_model('Software');

		$this->view->setLayout('master');

	}

    /**
     * Display a listing of the resource.
     *
     * @return \Router\View
     */
    public function index($params = '')
    {
        //get all the record

       // $system = System::all();
       //$system = System::paginate(4);
      // $Pagination = new Pagination();
    //   $Pagination->test();
  	//$this->view->subscribers = $this->Software->getPaginate(2);
 
     	$this->view->subscribers = $this->Software->paginate(10); 
		$this->view->render('software/index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Router\View
     */
	 
public function create()
{

	$validation = new validate();

$posted_values = [

			'org_name'=> '','org_num'=> '','org_address'=> '','org_email'=> '','fid'=> '' ];

					if($_POST)
					{
						$posted_values = posted_values($_POST);

						$validation->check($_POST, [

											'org_name'=> [
											'display'=> 'Organization Name',
											'required'=> true
												],

											'org_address'=> [
											'display'=> 'Organization Address' 
											],

											'org_num'=> [
											'display'=> 'Organization Number',
											'required'=> true,
											'unique'=> 'softwares',
											'min'=> 6,
											'max'=> 30
											],

											'org_email'=> [
											'display'=> 'Organization Email', 
											'unique'=> 'softwares', 
											'required'=> true,
											'max' => 50,
											'valid_email' => true
											],

											'fid'=> [
											'display'=> 'Feature Type',
											'required'=> true  
											] 
																		]);


				if($validation->passed())
				{
					$newSystem = new Software('software');
					$newSystem->registerNewSubscriber($_POST);
					
					if($newSystem)
					{
						Session::flash('success', 'New Subscriber has been added successfully');
					}
					Router::redirect('software/create');


				}
					}
					$this->view->post = $posted_values;

					$this->view->displayErrors = $validation->displayErrors();
	$Feature = new Feature('features');
	$this->view->features = $Feature->find();

	$this->view->render('software/create');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $system = System::find($id);
        return view('system.edit')->withSystem($system);
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //validate the input field

      $this->validate($request, array(
        'org_name'=> 'required|max:50',
        'org_address'=> 'required'

));

//save to the database

$system = system::find($id);

$system->org_name = $request->input('org_name');
$system->org_num = $request->input('org_num');
$system->org_email = $request->input('org_email');
$system->org_address = $request->input('org_address');
$system->active_feature = 'F101,F102';

$system->save();

//use flash message

$request->session()-> flash('success', 'Data Edited Successfully');

//redirect

return redirect()->route('system.show', $system->id);
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



}