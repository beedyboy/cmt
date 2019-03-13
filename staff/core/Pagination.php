<?php
/**
* 
*/
class Pagination// extends AnotherClass
{
		static private $_paginatorcount = 0;
		protected $_page = 1;	
		protected $_limit;	
			function __construct()
			{
			 
			}

		 
		/**
		 * [get description]
		 * @param  integer $limit      [5 per page on default]
		 * @param  array   $conditions [description]
		 * @param  array   $params     [description]
		 * @return [type]              [description]
		 */
		public function getPaginate($table, $limit = '',  $params= [], $page = 1)
		{
			if($limit === ''): $limit =PAGE_LIMIT;
			endif;

			$this->_limit  = $limit;
		//limit is default to 5 per page 
		//params [
		// conditions = []
		// value/bind
		//order
		//columns
		//]
		$conditionString = '';
			$bind = [];
			$order = '';

		 
		$per_page_html = ''; 
			$start=0;
		//check whether condition is set

		if(isset($params['conditions']))
		{

			if(is_array($params['conditions']))
			{
				foreach ($params['conditions'] as $condition)
				 {
					# code...
				
				$conditionString .= $condition. ' ';
				}

				$conditionString = trim($conditionString); 

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


	 
			 $this->_page =$page;
		 
 
		 
		$start_from = ($this->_page-1) * $limit; 

		$tsql = "SELECT * FROM {$table} {$conditionString}";

		$this->setCountForPagination($tsql, $bind);

		$sql = "SELECT * FROM {$table} {$conditionString} {$order} LIMIT {$start_from}, {$limit} ";
 
		return $resultQuery = $this->_db->query($sql, $bind); 

		}

public function pageLink($count, $class, $method='index', $argument=[])
{	

$args = '';

	if(!empty($argument)):
	foreach ($argument as   $value) 
	{
		$args.=$value.'/';
	}
 
	endif;

  $total_row = pageCount(); 

  $page_count=ceil($total_row/$this->_limit);

	$per_page_html = '<div class="pagination">';

	$per_page_html .= '<div class="page-item">';

	$per_page_html .= "Showing $count item(s) out of $total_row rows";
	$per_page_html .= '</div>';


	$per_page_html .= '<div class="page-buttons">';

	if($page_count>1) 
	{
			
			for($i=1; $i<= $page_count; $i++)
			{
				if($i==$this->_page)
				{
					$per_page_html .= "<a  id='" . $i . "'  class='page-link active'>$i</a>";
				} else
				 {
					$per_page_html .= " <a href='".base_url.$class.DS.$method.DS.$args.'page'.DS.$i."'  id='" . $i . "' class=' page-link userPagin'>$i</a>";
					}
			}
		}

$per_page_html .= '</div>';
$per_page_html .= '</div>';

 $GLOBALS['pageLink'] = $per_page_html;
}
 
public function pageLinks($count, $class, $method='index', $argument=[])
{	
 
	$args = '';

	if(!empty($argument)):
	foreach ($argument as   $value) 
	{
		$args.=$value.'/';
	}
 
	endif; 

	$total_row = pageCount(); 
  $page_count=ceil($total_row/$this->_limit);

	$per_page_html = '<div class="pagination">';

	$per_page_html .= '<div class="page-item">';

	$per_page_html .= "Showing $count item(s) out of $total_row row(s)";
	$per_page_html .= '</div>';


	$per_page_html .= '<div class="page-buttons">';

	if($page_count>1) 
	{
			
			for($i=1; $i<= $page_count; $i++)
			{
				if($i==$this->_page)
				{
					$per_page_html .= "<a  id='" . $i . "'  class='page-link active'>$i</a>";
				} else
				 {
					$per_page_html .= " <a href='#page=".$i."' caller='".base_url.$class.DS.$method.DS.$args.'page'.DS.$i."'  id='" . $i . "' class=' page-link ".$class.ucwords($method)."Pagin'>$i</a>";
					}
			}
		}

$per_page_html .= '</div>';
$per_page_html .= '</div>';



 $GLOBALS['pageLinks'] = $per_page_html;
}
 
public static function cc() 
{ 
	return 23333;
	 
}
 
/**
 * [setCountForPagination description]
 * @param [type] $query  [description]
 * @param [type] $params [description]
 */
public function setCountForPagination($query, $params=[]) 
{
	$db = DB::getInstance();
 $qry = $db->setCountForPagination($query, $params);

// $this->_paginatorcount = $qry;  
}

}