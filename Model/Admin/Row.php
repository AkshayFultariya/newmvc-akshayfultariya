<?php

class Model_Admin_Row extends Model_Core_Table_Row
{

	function __construct()
	{
		parent::__construct();
		$this->setTableClass('Model_Admin');
	}

	public function getStatus()
	{
		if ($this->status) {
			return $this->status;
		}
		return Model_Admin::STATUS_DEFAULT;
	}

	public function getStatusText($status)
	{
		$statuses = $this->getTable()->getStatusOptions();
		if (array_key_exists($this->status,$statuses)) {
			return $statuses[$this->status];
		}

		return $statuses[Model_Admin::STATUS_DEFAULT];
	}
	
}


// try {

// 			$this->getMessage()->getSession()->start();
// 			$product = new Block_Product_Grid();
// 			$this->getLayout()->addChild('product',$product)->render();

// 		} catch (Exception $e) {
// 		    $this->getMessage()->addMessage('Products not avilable',Model_Core_Message :: FAILURE);
			
// 		}




// try {

// 			$this->getMessage()->getSession()->start();

// 			$query = "SELECT * FROM `product` ORDER BY `product_id` DESC";
// 			$products = Ccc::getModel('Product_Row')->fetchAll($query);
// 			if (!$products) {
// 				throw new Exception("Error Processing Request", 1);
// 			}
// 			$this->getView()
// 			->setTemplate('product/grid.phtml')
// 			->setData(['products' => $products]);
// 			$this->render();

// 		} catch (Exception $e) {
// 		    $this->getMessage()->addMessage('Products not avilable',Model_Core_Message :: FAILURE);
			
// 		}