<?php

class Controller_Core_Front{
	
	protected $request = null;

	// $this->getMessage()->getSession()->start();
	public function setRequest($request){
		$this->request = $request;
	}

	public function getRequest(){
		if($this->request){
			return $this->request;
		}
		$request = new Model_Core_Request();
		$this->setRequest($request);
		return $request;
	}

	public function init(){
		$request = $this->getRequest();
		$controllerName = $request->getControllerName();
		// print_r($controllerName);

		// die();
		$controllerClassName = 'Controller_'.ucwords($controllerName,'_');
		$controllerClassPath = str_replace('_', '/', $controllerClassName);
		require_once "{$controllerClassPath}.php";

		$controller = new $controllerClassName;
		$actionName = $request->getactionName()."Action";

		if (!method_exists($controller, $actionName )) {
			$controller->errorAction($actionName);
		}
		else{
			$controller->$actionName();
		}
	}
}

?>