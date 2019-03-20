<?php 
//we are not gomnna intantiate it
//we will be using singleton pattern
class DB 
{
	private static $_instance = null;
	private $_pdo, $_query, $_error, $_result, $_count = 0,   $_paginatorcount = 0,   $_lastInsertedID = null; 
	private $y ="beedy";

	private function __construct()
	{
		try
		{
			$this->_pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';', DB_USER, DB_PASSWORD);
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		} 
		catch(PDOEXCEPTION $e)
		{
			die($e->getMessage());
		}
	}

public static function getInstance()
{
	if(!isset(self::$_instance))
	{
		self::$_instance = new DB();
	}

	return self::$_instance;
}

 


public function query($sql, $params=[])
{
//    dnd($sql);
	$this->_error = false; 
	if($this->_query  = $this->_pdo->prepare($sql))
	{
		$x = 1;
		if(count($params))
		{
			foreach($params as $param)
			{
				$this->_query->bindValue($x, $param);
				$x++;
			}
		}
		if($this->_query->execute())
		{
			$this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
			$this->_count = $this->_query->rowCount();
			$this->_lastInsertedID = $this->_pdo->lastInsertId(); 
		} else
		{
			$this->_error = true;
		}
	}

	//	dnd($this->_query);
	return $this;
}
/*
|--------------------------------------------------------------------------
| Read Structure
|--------------------------------------------------------------------------
|This method is protected and can only be accessed from members of this class
| It takes certain conditions and query then
| This methods query for the following
|	**conditions
|	** bind (which is thwe value of condition)
|	** order (column names sepearted by commas)
|	** limit
|****************************************************
|	$qry = $db->find("features", 					*
|	[												*
|													*
|		'conditions'=> ['name = ?'],				*
|		'bind' => ['Gold'],							*
|		'order'  => 'description', 'name',			*
|		'limit' => 2								*
|	]);												*
|****************************************************
|
*/
protected function _read($table, $params=[])
{
	$conditionString = '';
	$bind = [];
	$order = '';
	$limit = '';


//condition
if(isset($params['conditions']))
{
	//check if conditions was passed as an array or not
	if(is_array($params['conditions']))
	{
		foreach ($params['conditions'] as $condition) 
		{
			# code...
			$conditionString .= ' ' . $condition . ' AND';
		}

		$conditionString = trim($conditionString);
		$conditionString = rtrim($conditionString, ' AND');

	} else 
	{
		$conditionString = $params['conditions'];
	}

	if($conditionString != '')
	{

		$conditionString = ' WHERE ' .$conditionString;
	}
}

//bind
//checks if condition params was passed
if(array_key_exists('bind', $params))
{
	$bind = $params['bind'];
}

//order

if(array_key_exists('order', $params))
{
	$order =' ORDER BY ' . $params['order'];
}
//limit
if(array_key_exists('limit', $params))
{
	$limit =' LIMIT ' . $params['limit'];
}

$sql = "SELECT * FROM {$table} {$conditionString} {$order} {$limit} ";
// dnd($sql);
if($this->query($sql, $bind))
{
	if(!count($this->_result)) return false;
	return true;
}
return false;

}

public function find($table, $params=[])
{
 
	if($this->_read($table, $params))
	{
		return $this->results();
	}
	return false;
	
}

public function findFirst($table, $params=[])
{
	if($this->_read($table, $params))
	{
		return $this->first();
	}
	return false;
	
}
/*
|--------------------------------------------------------------------------
| Insert Usage
|--------------------------------------------------------------------------
|You have to instantiate the database object likt this $db = DB::getInstance();
|
| Then Set the Fields as follows
|****************************************************
|	$fields = [										*
|'name' => 'Gold',									*
|'description' => 'This is the golden feature'		*
|	];												*
|													*
|	$result = $db->insert('features', $fields);		*
|****************************************************
|
*/
public function insert($table, $fields = [])
{
	$fieldString = '';
	$valueString = '';
	$values  = [];


	foreach ($fields as $field => $value) 
	{
		# code...
		//$fieldString .=   '"' . $field . '", ';
		//$fieldString .=   "'". $field . "',";
		$fieldString .=   $field.',';

		if($field == "created_at" || $field == "updated_at")
		{
 
		$values[] = setTimeStamp();
		}
		else{

		$values[] = $value;
		}

		$valueString .= '?,'; 
	}

//trim the last comma for each of the following
	$fieldString = rtrim($fieldString, ',');
	$valueString = rtrim($valueString, ',');

$sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";
//if error is false  
	 if(!$this->query($sql, $values)->error())
		 {
		 	return true;
		 }

		 return false;
}


/*
|--------------------------------------------------------------------------
| Update Usage
|--------------------------------------------------------------------------
|You have to instantiate the database object likt this $db = DB::getInstance();
|
| Then Set the Fields as follows
|****************************************************
|	$fields = [										*
|'name' => 'Gold',									*
|'description' => 'This is the golden feature'		*
|	];												*
|													*
|	$result = $db->update('features', $fields, $id);*
|****************************************************
|
*/
public function update($table, $fields=[], $id)
{
$fieldString = ''; 
	$values  = [];


	foreach ($fields as $field => $value) 
	{
		# code...
		
		 if($field == "updated_at")
		{
 
		$values[] = setTimeStamp();
		}
		else{

		$values[] = $value;
		}
		$fieldString .=   $field.'= ?,'; 
	}

	$fieldString =  trim($fieldString);
	$fieldString =  rtrim($fieldString, ',');
	$sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
 
 if(!$this->query($sql, $values)->error())
		 {
		 	return true;
		 }

		 return false;
}

/*
|--------------------------------------------------------------------------
| Delete Usage
|--------------------------------------------------------------------------
|You have to instantiate the database object likt this $db = DB::getInstance();
|
| Then call the delete function and padd the values
|****************************************************
|	 												*
|	$result = $db->delete('features', $id);		*
|****************************************************
|
*/

public function delete($table, $id=1)
{ 

	$sql = "DELETE FROM {$table} WHERE id  = {$id}";

	//dnd($sql);
 if(!$this->query($sql)->error())
		 {
		 	return true;
		 }

		 return false;

}

/*
|--------------------------------------------------------------------------
| Delete Usage
|--------------------------------------------------------------------------
|You have to instantiate the database object likt this $db = DB::getInstance();
|
| Then call the delete function and padd the values
|****************************************************
|	 												*
|	$result = $db->delete('features', $id);		*
|****************************************************
|
*/
public function results()
{
	return $this->_result;
}


/*
|--------------------------------------------------------------------------
| First Usage
|--------------------------------------------------------------------------
|You have to instantiate the database object likt this $db = DB::getInstance();
|
| Then call the first function which return the first value in the row
|********************************************************
|	 													*
|$qry = $db->query("SELECT * FROM features")->first();  *
|********************************************************
|
*/
public function first()
{
	return (!empty($this->_result))? $this->_result[0] : [];
}

/*
|--------------------------------------------------------------------------
| lastID Usage
|--------------------------------------------------------------------------
|After inserting, you can ge the last iD of what is inserted
|
|  
|********************************************************
|	 													*
|$qry = $db->lastID(); 									*
|********************************************************
|
*/
public function lastID()
{
	return $this->_lastInsertedID;
} 

/*
|--------------------------------------------------------------------------
| Count Usage
|--------------------------------------------------------------------------
|After doing the query to fetch result
|
| Then call the count function to get the total number of rows
|****************************************************
|	 												*
|	$result = $db->count();							*
|****************************************************
|
*/
public function count()
{
	return $this->_count;
}

/*
|--------------------------------------------------------------------------
| getColumns Usage
|--------------------------------------------------------------------------
|You have to instantiate the database object likt this $db = DB::getInstance();
|
| Then call the delete function and padd the values
|****************************************************
|	 												*
|	$result = $db->delete('features', $id);		*
|****************************************************
|
*/
public function getColumns($table)
{
	return $this->query("SHOW COLUMNS FROM {$table} ")->results();
}

public function error()
{
	return $this->_error;
}

 
/**
 * [setCountForPagination description]
 * @param [type] $query  [description]
 * @param [type] $params [description]
 */
public function setCountForPagination($query, $params=[]) 
{
 
 $qry = $this->_pdo->prepare($query);
		$x = 1;
		if(count($params))
		{
			foreach($params as $param)
			{
				$qry->bindValue($x, $param);
				$x++;
			}
		}
		if($qry->execute())
		{
		 
		$this->_paginatorcount = $qry->rowCount(); 
		return true;
		} else
		{
			return false;;
		}
 
}

/**
 * [getCountForPagination returns the totle number of rows]
 * @return [int] [paginator row count]
 */
public function getCountForPagination() 
{ 
	return $this->_paginatorcount;
	 
}
     /**
     * Paginate the given query.
     *
     * @param  int  $perPage
     * @param  array  $columns
     * @param  string  $pageName
     * @param  int|null  $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     *
     * @throws \InvalidArgumentException
     */
    public function paginator($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        $page = $page ?: Paginator::resolveCurrentPage($pageName);

        $perPage = $perPage ?: $this->model->getPerPage();

        $results = ($total = $this->toBase()->getCountForPagination())
                                    ? $this->forPage($page, $perPage)->get($columns)
                                    : $this->model->newCollection();

        return $this->paginator($results, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ]);
    }
}