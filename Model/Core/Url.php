<?php

class Model_Core_Url
{
	public function getCurrentUrl()
	{
		return $_SERVER['REQUEST_SCHEME'].'://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		// print_r($_SERVER);
	}

	public function getUrl($controller = null,$action = null,$params = [], $reset  = false)

	{
	   $request = new Model_Core_Request();

	   $final = $request->getParam();

	   if ($reset) {
	   	$final = [];
	   }

	   if ($controller) {
	   		$final['c'] = $controller; 
	   }
	   else{
	   		$final['c'] =$request->getControllerName();
	   }

	   if ($action) {
	   	   $final['a'] = $action;
	   }
	   else{
	   	   $final['a'] = $request->getActionName();
	   }

	   if ($params) {
	   	   $final = array_merge($final,$params);
	   }

	   $queryString = http_build_query($final);
	   // echo "<pre>";
	   // print_r($queryString);
	   // echo "<br>";
	   $requestUri = trim($_SERVER['REQUEST_URI'],$_SERVER['QUERY_STRING']);
	   // print_r($requestUri);

	   $url = $_SERVER['REQUEST_SCHEME'].'://'. $_SERVER['HTTP_HOST'].$requestUri.$queryString;

	   return $url;
	}
}


