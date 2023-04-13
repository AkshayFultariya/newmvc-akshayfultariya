<?php

class Model_Customer extends Model_Core_Table{

   
   // const STATUS_DEFAULT= 1;
   public $data = [];


   public function getStatus()
   {
      if ($this->status) {
         return $this->status;
      }
      return Model_Customer_Resource::STATUS_DEFAULT;
   }

   public function getStatusText($status)
   {
      $statuses = $this->getResource()->getStatusOptions();
      if (array_key_exists($this->status,$statuses)) {
         return $statuses[$this->status];
      }
      return $statuses[Model_Customer_Resource::STATUS_DEFAULT];
   }

   public function __construct()
   {
      parent::__construct();

      $this->setResourceClass('Model_Customer_Resource');
      $this->setCollectionClass('Model_Customer_Collection');
   }

// getaddresses getbillingaddress 
//    public function getAddresses()
//    {
//       $query = "SELECT * FROM `customer_address` WHERE 1";
//       $address = Ccc::getModel('Customer')->fetchAll($query);
//    } 

//    public function getBillingId()
//    {
//       $query = "SELECT * FROM `customer_address` WHERE `address_id";
//       $result = Ccc::getModel('Customer_Address')->fetchRow($query); 
//    }

//    public function getShippingId()
//    {
//       $query = "SELECT `customer_address`.* FROM `customer_address` LEFT JOIN `customer` ON `customer_address`.`address_id`=`customer`.`shipping_id`";
//       $result = Ccc::getModel('Customer_Address')->fetchRow($query);
//       // print_r($result);
//    }
// // silenium php unit test jan kung

// //http refrer means je url mathi aapade aaviya hoy te
// // list photo
// }

   public function getBillingAddress()
   {
      $customerAddress = Ccc::getModel('Customer_Address_Resource');
      // $query = "SELECT * FROM `{$customerAddress->getResourceName()}` WHERE `{$customerAddress->getPrimaryKey()}` = $this->billing_address_id";
      $query = "SELECT * FROM `{$customerAddress->getResourceName()}` WHERE `{$customerAddress->getPrimaryKey()}` = '29'";
      // print_r($query);
      // die();
      $a =  $customerAddress->fetchAll($query);
      if ($a) {
         $this->data = $a;
      }
      return $this;
      // die();
   }

   public function getShippingAddress()
   {
      $customerAddress = Ccc::getModel('Customer_Address_Resource');
      // $query = "SELECT * FROM `{$customerAddress->getResourceName()}` WHERE `{$customerAddress->getPrimaryKey()}` = $this->shipping_address_id";
      $query = "SELECT * FROM `{$customerAddress->getResourceName()}` WHERE `{$customerAddress->getPrimaryKey()}` = '30'";
      // return $customerAddress->fetchAll($query);
      $a =  $customerAddress->fetchAll($query);
      if ($a) {
         $this->data = $a;
      }
      return $this;
   }

   public function getAddresses()
   {
      $customerAddress = Ccc::getModel('Customer_Address_Resource');
      $query = "SELECT * FROM `{$customerAddress->getResourceName()}` WHERE `{$this->getPrimaryKey()}` = $this->customer_id";
      return $customerAddress->fetchAll($query);
   }

}










// $git checkout jema jav hoy te

