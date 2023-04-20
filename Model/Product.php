<?php

class Model_Product extends Model_Core_Table{

   
   // const STATUS_DEFAULT= 1;
   const ENTITY_TYPE_ID = 1;


   public function getStatus()
   {
      if ($this->status) {
         return $this->status;
      }
      return Model_Product_Resource::STATUS_DEFAULT;
   }

   public function getStatusText($status)
   {
      $statuses = $this->getResource()->getStatusOptions();
      if (array_key_exists($this->status,$statuses)) {
         return $statuses[$this->status];
      }
      return $statuses[Model_Product_Resource::STATUS_DEFAULT];
   }

   public function __construct()
   {
      parent::__construct();

      $this->setResourceClass('Model_Product_Resource');
      $this->setCollectionClass('Model_Product_Collection');
   }

  
   public function getAttributes()
   {
      $sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = 1 AND `status` = 1";
      $attributes =Ccc::getModel('Eav_Attribute')->fetchAll($sql);
      // print_r($attributes);
      // die();
      if ($attributes) {
           return $attributes->getData();
      }
      return Ccc::getModel('Eav_Attribute');
   }

   public function getAttributeValue($attribute)
   {
      $sql = "SELECT `value` FROM `product_{$attribute->backend_type}` WHERE `product_id` = '{$this->getId()}' AND `attribute_id` = '{$attribute->getId()}'";
      // print_r($sql);
      // die();

      return $this->getResource()->getAdapter()->fetchOne($sql);
   }
}
//http refrer means je url mathi aapade aaviya hoy te



