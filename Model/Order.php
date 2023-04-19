<?php

class Model_Order extends Model_Core_Table{

   
   // const STATUS_DEFAULT= 1;


   public function getStatus()
   {
      if ($this->status) {
         return $this->status;
      }
      return Model_Order_Resource::STATUS_DEFAULT;
   }

   public function getStatusText($status)
   {
      $statuses = $this->getResource()->getStatusOptions();
      if (array_key_exists($this->status,$statuses)) {
         return $statuses[$this->status];
      }
      return $statuses[Model_Order_Resource::STATUS_DEFAULT];
   }

   public function __construct()
   {
      parent::__construct();

      $this->setResourceClass('Model_Order_Resource');
      $this->setCollectionClass('Model_Order_Collection');
   }
}
//http refrer means je url mathi aapade aaviya hoy te



