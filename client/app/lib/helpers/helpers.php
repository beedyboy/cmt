<?php
 

$GLOBALS['pageCount'] = null;
$GLOBALS['pageLink'] = null;
 $GLOBALS['pageLinks']  = null;
 
function dnd($data)
{
	echo '<pre>';

var_dump($data);
die();
	echo '</pre>';

}

function sanitize($dirty)
{
	return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
}
 
 function currentUser()
 {
 
 	return Admin::currentLoggedInUser();
 }

 function getUserId()
{
return Session::get(CURRENT_USER_SESSION_NAME);
 
}

 function posted_values($post)
 {
 	$clean_ary = [];
 	foreach ($post as $key => $value) 
 	{
 		# code...
 	$clean_ary[$key] =  sanitize($value);
 	}
 	return $clean_ary;
 }

 function currentPage()
 {
 	$currentPage = $_SERVER['REQUEST_URI'];
 	if($currentPage == base_url || $currentPage == base_url.'home/index')
 	{
 		$currentPage = base_url . 'home';
 	}
 	return $currentPage;
 }

 function setTimeStamp()
 {
 	$date = new DateTime();
	 	return $date->format('Y-m-d H:i:s');

 }

function pageCount()
{

//$paginate = new pagination();
// return $paginate->getCountForPagination();
return $GLOBALS['pageCount'];

}

function pageLink()
{
    echo $GLOBALS['pageLink'];
}

function pageLinks()
{
	echo  $GLOBALS['pageLinks'] ;
}
 /**
  * [currentURL description]
  * @return [type] [description]
  */
 function currentURL()
 {
 	return 	$server = $_SERVER['REQUEST_URI'];
 }
/**
 * [resolveCurrentPath description]
 * @return [type] [description]
 */
 function resolveCurrentPath()
{
	$server = currentURL();

	$base_url = ''; 
	$newBase = [];

	$base_url = explode('/', base_url);
	foreach ($base_url as $url) 
	{
		# code...
		 if($url != '')
		 {
	
	 $newBase[] = '/'.$url;

		 }
	}
		
	 $reg ='';

	 foreach ($newBase as $base)
	  {
	 	
	 	$reg .= "\\".$base; 
	 }
	 //the regex
	 $reg = "/($reg)/";
 $server = preg_replace($reg, '', $server);
	return $server;

}

function pageNum($resolvedUrl)
	{
	$pageNum = 1;
	$regex = explode('/',$resolvedUrl); 
	if(in_array('page', $regex))
	{
		$count = count($regex);
		$pageNum = array_values(array_slice($regex, -1))[0];
	 
	}
	return $pageNum;
}


function aclHelper($value, $controls)
{
    if($value == "*" && $controls != "Other")
    {
        $all = '';
     
         $all.= "<li>Create $controls</li>";
       
        $all.= "<li>Read $controls</li>";
        
       $all.= "<li>Update $controls</li>";
       if($controls != "Role"):
          $all.= "<li>Delete $controls</li>";
        endif;
          return $all;
       
    } 
    else
    {
       if($value == "c"):
            return "<li>Create $controls</li>";
         elseif ($value == "r"):
             return "<li>Read $controls</li>";
         elseif ($value == "u"):
             return "<li>Update $controls</li>";
        elseif ($value == "d"):
             return "<li>Delete $controls</li>";

        endif;
    }
}

function actionAcl($page, $action='')
{
    $accept = false; 
   $permissions = currentUser()->acls();
dnd($permissions);
  if(!empty($permissions[$page]) && (in_array("*", $permissions[$page]))): 
    $accept = true;
    elseif (!empty($permissions[$page]) && (in_array($action, $permissions[$page]))):
     $accept = true ; 
    
    endif; 
return  $accept;

}


  function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
   // return '&#8358;'. $number.'k';
}
 
 function removeComma($value){
$value = str_replace(',','',$value);
return $value;
}


function sendSMS($post)
{
    $phone= explode(',',$post['phone']);
    $x=1;
    foreach($phone as $value)
    {
        echo $value.'-'.$x;
        echo "<br/>";
        $x++;
    }
}
    /**
     * Replace the parameters on the root path.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @param  string  $domain
     * @param  array  $parameters
     * @return string
     */
     function replaceRootParameters($route, $domain, &$parameters)
    {
        $scheme = $this->getRouteScheme($route);

        return $this->replaceRouteParameters(
            $this->url->formatRoot($scheme, $domain), $parameters
        );
    }

    /**
     * Replace all of the wildcard parameters for a route path.
     *
     * @param  string  $path
     * @param  array  $parameters
     * @return string
     */
     function replaceRouteParameters($path, array &$parameters)
    {
        $path = $this->replaceNamedParameters($path, $parameters);

        $path = preg_replace_callback('/\{.*?\}/', function ($match) use (&$parameters) {
            return (empty($parameters) && ! Str::endsWith($match[0], '?}'))
                        ? $match[0]
                        : array_shift($parameters);
        }, $path);

        return trim(preg_replace('/\{.*?\?\}/', '', $path), '/');
    }

    /**
     * Replace all of the named parameters in the path.
     *
     * @param  string  $path
     * @param  array  $parameters
     * @return string
     */
     function replaceNamedParameters($path, &$parameters)
    {
        return preg_replace_callback('/\{(.*?)\??\}/', function ($m) use (&$parameters) {
            if (isset($parameters[$m[1]])) {
                return Arr::pull($parameters, $m[1]);
            } elseif (isset($this->defaultParameters[$m[1]])) {
                return $this->defaultParameters[$m[1]];
            }

            return $m[0];
        }, $path);
    }

    /**
     * Add a query string to the URI.
     *
     * @param  string  $uri
     * @param  array  $parameters
     * @return mixed|string
     */
     function addQueryString($uri, array $parameters)
    {
        // If the URI has a fragment we will move it to the end of this URI since it will
        // need to come after any query string that may be added to the URL else it is
        // not going to be available. We will remove it then append it back on here.
        if (! is_null($fragment = parse_url($uri, PHP_URL_FRAGMENT))) {
            $uri = preg_replace('/#.*/', '', $uri);
        }

        $uri .= $this->getRouteQueryString($parameters);

        return is_null($fragment) ? $uri : $uri."#{$fragment}";
    }

    /**
     * Get the query string for a given route.
     *
     * @param  array  $parameters
     * @return string
     */
     function getRouteQueryString(array $parameters)
    {
        // First we will get all of the string parameters that are remaining after we
        // have replaced the route wildcards. We'll then build a query string from
        // these string parameters then use it as a starting point for the rest.
        if (count($parameters) == 0) {
            return '';
        }

        $query = http_build_query(
            $keyed = $this->getStringParameters($parameters)
        );

        // Lastly, if there are still parameters remaining, we will fetch the numeric
        // parameters that are in the array and add them to the query string or we
        // will make the initial query string if it wasn't started with strings.
        if (count($keyed) < count($parameters)) {
            $query .= '&'.implode(
                '&', $this->getNumericParameters($parameters)
            );
        }

        return '?'.trim($query, '&');
    }

    /**
     * Get the string parameters from a given list.
     *
     * @param  array  $parameters
     * @return array
     */
     function getStringParameters(array $parameters)
    {
        return array_filter($parameters, 'is_string', ARRAY_FILTER_USE_KEY);
    }

    /**
     * Get the numeric parameters from a given list.
     *
     * @param  array  $parameters
     * @return array
     */
     function getNumericParameters(array $parameters)
    {
        return array_filter($parameters, 'is_numeric', ARRAY_FILTER_USE_KEY);
    }

    /**
     * Set the default named parameters used by the URL generator.
     *
     * @param  array  $defaults
     * @return void
     */
      function defaults(array $defaults)
    {
        $this->defaultParameters = array_merge(
            $this->defaultParameters, $defaults
        );
    }