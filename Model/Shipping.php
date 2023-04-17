<?php

class Model_Shipping extends Model_Core_Table{

   
   // const STATUS_DEFAULT= 1;


   public function getStatus()
   {
      if ($this->status) {
         return $this->status;
      }
      return Model_Shipping_Resource::STATUS_DEFAULT;
   }

   public function getStatusText($status)
   {
      $statuses = $this->getResource()->getStatusOptions();
      if (array_key_exists($this->status,$statuses)) {
         return $statuses[$this->status];
      }
      return $statuses[Model_Shipping_Resource::STATUS_DEFAULT];
   }

   public function __construct()
   {
      parent::__construct();

      $this->setResourceClass('Model_Shipping_Resource');
      $this->setCollectionClass('Model_Shipping_Collection');
   }
}
//http refrer means je url mathi aapade aaviya hoy te



