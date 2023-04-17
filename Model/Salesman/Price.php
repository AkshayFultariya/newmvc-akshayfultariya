<?php

class Model_Salesman_Price extends Model_Core_Table{

   
   // const STATUS_DEFAULT= 1;

   public function __construct()
   {
      parent::__construct();

      $this->setResourceClass('Model_Salesman_Price_Resource');
      $this->setCollectionClass('Model_Salesman_Price_Collection');
   }
}
//http refrer means je url mathi aapade aaviya hoy te



