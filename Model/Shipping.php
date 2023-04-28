<?php

class Model_Shipping extends Model_Core_Table{

   
   // const STATUS_DEFAULT= 1;
   const ENTITY_TYPE_ID = 8;


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

   public function getAttributes()
   {
      $sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = 8 AND `status` = 1";
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
      $sql = "SELECT `value` FROM `shipping_{$attribute->backend_type}` WHERE `shipping_id` = '{$this->getId()}' AND `attribute_id` = '{$attribute->getId()}'";

      return $this->getResource()->getAdapter()->fetchOne($sql);
   }

   // public function pageCalculate()
}
//http refrer means je url mathi aapade aaviya hoy te



