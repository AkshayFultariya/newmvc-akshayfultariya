<?php

class Controller_Salesman_Price extends Controller_Core_Action
{
	protected $salesmanprices = null;
	protected $salesmanPriceModel = null;
	protected $salesmanPriceUrl = null;
	protected $salesmanPriceId = null;

	public function setSalesmanPrices($salesmanprices)
	{
		$this->salesmanprices = $salesmanprices;
		return $this;
	}

	public function getSalesmanPrices()
	{
		return $this->salesmanprices;
	}


	public function setSalesmanPriceId($salesmanPriceId)
	{
		$this->salesmanPriceId = $salesmanPriceId;
		return $this;
	}

	public function getSalesmanPriceId()
	{
		return $this->salesmanPriceId;
	}


	public function setSalesmanPriceModel($salesmanPriceModel)
	{
		$this->salesmanPriceModel = $salesmanPriceModel;
		return $this;
	}

	public function getSalesmanPriceModel()
	{
		if ($this->salesmanPriceModel != null) {
			return $this->salesmanPriceModel;
		}
		$salesmanPriceModel = new Model_Salesman_Price_Resource();
		$this->setSalesmanPriceModel($salesmanPriceModel);
		return $salesmanPriceModel;
	}

	public function setSalesmanPriceUrl($salesmanPriceUrl)
	{
		$this->salesmanPriceUrl = $salesmanPriceUrl;
		return $this;
	}

	public function getSalesmanPriceUrl()
	{
		if ($this->salesmanPriceUrl != null) {
			return $this->salesmanPriceUrl;
		}
		$salesmanPriceUrl = new Model_Core_Url;
		$this->setSalesmanPriceUrl($salesmanPriceUrl);
		return $salesmanPriceUrl;
	}

	public function gridAction()
	{
    	$this->getMessage()->getSession()->start();

		// $salesmanId = $this->getRequest()->getParam('salesman_id');
		// // $this->setSalesmanPriceId($salesmanId);

		// $sql = "SELECT * FROM `salesman` ORDER BY `first_name` ASC";
		// $salesmen = Ccc::getModel('Salesman_Price')->fetchAll($sql);

		// $query = "SELECT P.*,SP.salesman_price FROM `product` P LEFT JOIN `salesman_price` SP ON P.product_id = SP.product_id AND SP.salesman_id = {$salesmanId}";
		// $salesmanPrices = Ccc::getModel('Salesman_Price')->fetchAll($query);

    	$layout = $this->getLayout();
        	$add = $layout->createBlock('Salesman_Price_Grid');
			$layout->getChild('content')->addChild('content',$add);
			$layout->render();

		// $this->getView()
		// 	->setTemplate('salesman_price/grid.phtml')
		// 	->setData(['salesmanId' => $salesmanId,'salesmen' => $salesmen,'salesmanPrices' => $salesmanPrices]);
		// 	$this->render();
	}

	public function updateAction()
	{
		try {
        	$this->getMessage()->getSession()->start();

			$salesmanId = $this->getRequest()->getParam('salesman_id');
			$salesmanPricePost = $this->getRequest()->getPost('s_price');

			foreach ($salesmanPricePost as $productId => $salesmanPrice) {
				$sql = "SELECT * FROM `salesman_price` WHERE `salesman_id` = {$salesmanId} AND `product_id` = {$productId}";
				$result = Ccc::getModel('Salesman_Price')->fetchRow($sql);

				if ($result->salesman_price
				 == null) {
					if ($salesmanPrice != '') {
						$salesmanPriceInsert['salesman_id'] = $salesmanId;
						$salesmanPriceInsert['product_id'] = $productId;
						$salesmanPriceInsert['salesman_price'] = $salesmanPrice;

						$priceInsert = $this->getSalesmanPriceModel()->insert($salesmanPriceInsert);
						
					}
				}
				else{
					$salesmanPriceUpdate['salesman_price'] = $salesmanPrice;

					$condition['entity_id'] = $result->entity_id;

					$priceUpdate = $this->getSalesmanPriceModel()->update($salesmanPriceUpdate,$condition);
					if (!$priceUpdate) {
						throw new Exception("Error Processing Request", 1);
					}
					$this->getMessage()->addMessage('Salesman updated sucessfully',Model_Core_Message :: SUCCESS);

				}
	       }
		} catch (Exception $e) {
			$this->getMessage()->addMessage('data not updated',Model_Core_Message :: FAILURE);
			
		}
		
			$this->redirect('salesman','grid',['salesman_id' =>$salesmanId],true);
		
		// die();
	}

	public function deleteAction()
	{

		try {
	        $this->getMessage()->getSession()->start();

			$salesmanId = $this->getrequest()->getParam('salesman_id');
			$productId = $this->getrequest()->getParam('product_id');

			$conditions['salesman_id'] = $salesmanId;
			$conditions['product_id'] = $productId;

			$result = $this->getSalesmanPriceModel()->delete($conditions);

			if (!$result) {
				throw new Exception("Error Processing Request", 1);
			}
		$this->getMessage()->addMessage('Salesman deleted sucessfully',Model_Core_Message :: SUCCESS);

			
		} catch (Exception $e) {
			$this->getMessage()->addMessage('data not deleted',Model_Core_Message :: FAILURE);

		}
		

		$this->redirect('salesman_price','grid',['salesman_id' => $salesmanId],true);

	}
}

?>