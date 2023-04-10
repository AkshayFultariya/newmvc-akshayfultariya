<?php

class Controller_Eav_Attribute extends Controller_Core_Action
{
	
	public function gridAction()
	{
		// $attribute = Ccc::getModel('Eav_Attribute');
		// $query = "SELECT * FROM `eav_attribute`";
		// $data = $attribute->fetchAll($query);
		// echo "<pre>";
		// print_r($data);
		// die();

		$this->getMessage()->getSession()->start();
			$layout = $this->getLayout();
			$grid = new Block_Eav_Attribute_Grid();
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
	}

	public function addAction()
	{
		try {
        	$this->getMessage()->getSession()->start();
        	$add = new Block_Eav_Attribute_Edit();
        	$layout = $this->getLayout();
			$layout->getChild('content')->addChild('content',$add);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Eav_Attribute not showed.',Model_Core_Message :: FAILURE);
		}
		
	}
}

?>