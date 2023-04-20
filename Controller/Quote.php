<?php

class Controller_Quote extends Controller_Core_Action
{
	
	public function newAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Quote_Customer');
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
		} catch (Exception $e) {
	    	$this->getMessage()->addMessage('Currently Quotes not avilable',Model_Core_Message :: FAILURE);
			
		}
        	
	}


}