<?php

class Model_Payment extends Model_Core_Table{

   // const STATUS_DEFAULT= 1;
   const ENTITY_TYPE_ID = 7;

   public function getStatus()
   {
      if ($this->status) {
         return $this->status;
      }
      return Model_Payment_Resource::STATUS_DEFAULT;
   }

   public function getStatusText($status)
   {
      $statuses = $this->getResource()->getStatusOptions();
      if (array_key_exists($this->status,$statuses)) {
         return $statuses[$this->status];
      }
      return $statuses[Model_Payment_Resource::STATUS_DEFAULT];
   }

   public function __construct()
   {
      parent::__construct();

      $this->setResourceClass('Model_Payment_Resource');
      $this->setCollectionClass('Model_Payment_Collection');
   }

   public function getAttributes()
   {
      $sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = 7 AND `status` = 1";
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
      $sql = "SELECT `value` FROM `payment_{$attribute->backend_type}` WHERE `payment_method_id` = '{$this->getId()}' AND `attribute_id` = '{$attribute->getId()}'";

      return $this->getResource()->getAdapter()->fetchOne($sql);
   }
}
//http refrer means je url mathi aapade aaviya hoy te



