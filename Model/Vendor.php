<?php

class Model_Vendor extends Model_Core_Table{

   
   // const STATUS_DEFAULT= 1;


   public function getStatus()
   {
      if ($this->status) {
         return $this->status;
      }
      return Model_Vendor_Resource::STATUS_DEFAULT;
   }

   public function getStatusText($status)
   {
      $statuses = $this->getResource()->getStatusOptions();
      if (array_key_exists($this->status,$statuses)) {
         return $statuses[$this->status];
      }
      return $statuses[Model_Vendor_Resource::STATUS_DEFAULT];
   }

   public function __construct()
   {
      parent::__construct();

      $this->setResourceClass('Model_Vendor_Resource');
      $this->setCollectionClass('Model_Vendor_Collection');
   }

   public function getAttributes()
   {
      $sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = 4 AND `status` = 1";
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
      $sql = "SELECT `value` FROM `vendor_{$attribute->backend_type}` WHERE `vendor_id` = '{$this->getId()}' AND `attribute_id` = '{$attribute->getId()}'";

      return $this->getResource()->getAdapter()->fetchOne($sql);
   }
}
//http refrer means je url mathi aapade aaviya hoy te



