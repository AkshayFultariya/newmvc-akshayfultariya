<?php

class Controller_Order extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Order_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
			
		} catch (Exception $e) {
			
		}
	}
}
