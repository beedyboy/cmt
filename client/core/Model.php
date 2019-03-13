<?php
/**
	* 
	*/
	class Model extends Pagination
	{
		protected $_db, $_table, $_modelName, $_softDelete = false, $_columnsNames = [];
		public $id;
		
		public function __construct($table)
		{
			// dnd("i have been called");
			# code...
$table=  Pluralizer::plural($table); 

		$this->_db = DB::getInstance();
		$this->_table = $table;
		$this->_setTableColumns();
		$this->_modelName =   Pluralizer::singular(str_replace('', '', ucwords(str_replace('_', ' ', $this->_table))) );
							// this will table our table name .
							// if it has underscore(it would remove it and capitalize each word) 
							// i.e $table = user_session 
							// this will turn to UserSession

		}


/**************************

This method is used to get
our table columns in the 
database
-------------------------*/
protected function _setTableColumns()
{
	$columns = $this->get_columns();
	foreach($columns as $column)
	{
		$columnName = $column->Field;
		$this->_columnsNames[] = $column->Field;
		$this->{$columnName} = null;
	}
}

/**************************

This function clones the 
db getColumns function
-------------------------*/

public function get_columns()
{
 
	 return $this->_db->getColumns($this->_table);
	
}	

//we are extracting the find method in the db
public function find($params = [])
{
$results = [];
// dnd($this->_table);
$resultQuery = $this->_db->find($this->_table, $params);
 
 // dnd( $this->_table);
 if($resultQuery):
//for each object of the result
foreach ($resultQuery as $result) 
{
	# code...
	# create an instance of the model and pass the table name in there
	$obj = new $this->_modelName($this->_table);
	 $obj->populateObjData($result);


	$results[] = $obj;
}
endif;
return $results;
}


public function findFirst($params = [])
{

	$resultQuery = $this->_db->findFirst($this->_table, $params);

	$result = new $this->_modelName($this->_table);

 if($resultQuery){
 	
 $result->populateObjData($resultQuery);
 }

 return $result;
}
public function findById($id)
{
	return $this->findFirst(['conditions'=> 'id = ?', 'bind' => [$id] ]);
}

public function findByEmail($email)
{
	return $this->findFirst(['conditions'=> 'email = ?', 'bind' => [$email] ]);
}

 

public function findByusername($username)
{
	return $this->findFirst(['conditions'=> 'username = ?', 'bind' => [$username] ]);
}

 
public function findWhere($table, $params = [])
{


	return $this->_db->find($table, $params);
}

 

public function paginate($limit = '',  $params= [])
{

	$arg[] = func_get_arg(0);
  $method = debug_backtrace()[1]['function'];
   $args = debug_backtrace()[1]['args'];

   
// dnd(   $_SERVER['REQUEST_URI']);
$resolvedUrl = resolveCurrentPath();
 
//get the page number

$pageNum = pageNum($resolvedUrl); 
 
   
$results = [];
		$resultQuery = $this->getPaginate($this->_table, $limit,  $params , $pageNum); 
// return $resultQuery->results();
//for each object of the result
$GLOBALS['pageCount'] =  $resultQuery->getCountForPagination();
$page = $this->pageLink($resultQuery->count(), $this->_modelName, $method, $args);
$pages = $this->pageLinks($resultQuery->count(), $this->_modelName, $method, $args);
 
 
foreach ($resultQuery->results() as $result) 
{
	# code...
	# create an instance of the model and pass the table name in there
	$obj = new $this->_modelName($this->_table);
	 $obj->populateObjData($result);


	$results[] = $obj;
}
 
return $results;
} 

public function resolveCurrentPath()
{
$server = $_SERVER['REQUEST_URI'];

$base_url = '';

$newBase = [];
$base_url = explode('/', base_url);
foreach ($base_url as $url) 
{
	# code...
	 if($url != ''){
 $newBase[] = '/'.$url;
}
	 }
	
 $reg ='';

 foreach ($newBase as $base)
  {
 	
 	$reg .= "\\".$base;
 	// $reg .= "\{$base}";
 }
 $reg = "/($reg)/";

 // resolveURL();
$server = preg_replace($reg, '', $server);
dnd($server);

}


/**
 * [getCountForPagination returns the totle number of rows]
 * @return [int] [paginator row count]
 */
public function getCountForPagination() 
{ 
	return $this->_paginatorcount;
	 
}


public function save()
{
	$fields = [];
	foreach ($this->_columnsNames as $column) {
		# code...
		$fields[$column] =  $this->$column;
	}
	//determine whether to update or insert
	if(property_exists($this, 'id') && $this->id != '')
	{
		return $this->update($fields, $this->id);
	} else 
	{
		return $this->insert($fields);
	}
}


public function insert($fields)
{ 
	if(empty($fields)) return false;
	return $this->_db->insert($this->_table, $fields);
}

public function update($fields, $id)
{
	 if(empty($fields) || $id == '') return false;
	 return $this->_db->update($this->_table, $fields, (int)$id);
} 

public function delete($id = '')
{

	if($id == '' && $this->id == '') return false;
	//if($id == '') $id = $this->id;
	$id = ($id == '')? $this->id : $id;
 
	 if($this->_softDelete)
	{
	return	$this->update(['deleted' => 1], $id);

	}
	return $this->_db->delete($this->_table, $id);

}



public function query($sql, $bind = [])
{
	return $this->_db->query($sql, $bind);
}

public function data()
{
	$data = new stdClass();
	foreach ($this->_columnNames as $column) 
	{
		# code...
		$data->_column = $this->column;
	}
	return $data;
}

public function assign($params)
{	 
	if(!empty($params))
	{
		foreach ($params as $key => $value)
		 {
			# code...
		if(in_array($key, $this->_columnsNames))
		{
			$this->$key = sanitize($value);
		}

		}
		return true;
	}
	return false;
}

protected function populateObjData($result)
{
	foreach ($result as $key => $value) 
	{
		# code...
		$this->$key = $value;
	}
}

}
