<?php

class Model_Vendor_Address extends Model_Core_Table{

   
   // const STATUS_DEFAULT= 1;

   public function __construct()
   {
      parent::__construct();

      $this->setResourceClass('Model_Vendor_Address_Resource');
      $this->setCollectionClass('Model_Vendor_Address_Collection');
   }
}
//http refrer means je url mathi aapade aaviya hoy te



