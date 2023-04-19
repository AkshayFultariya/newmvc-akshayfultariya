<?php

class Controller_Quote extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Quote_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
		} catch (Exception $e) {
	    	$this->getMessage()->addMessage('Currently Quotes not avilable',Model_Core_Message :: FAILURE);
			
		}
        	
	}


}