<?php

class Model_Brand extends Model_Core_Table{

   
   // const STATUS_DEFAULT= 1;


   public function __construct()
   {
      parent::__construct();

      $this->setResourceClass('Model_Brand_Resource');
      $this->setCollectionClass('Model_Brand_Collection');
   }
}
//http refrer means je url mathi aapade aaviya hoy te



