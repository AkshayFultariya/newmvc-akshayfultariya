<?php

class Model_Category extends Model_Core_Table{

   
   // const STATUS_DEFAULT= 1;


   public function getStatus()
   {
      if ($this->status) {
         return $this->status;
      }
      return Model_Category_Resource::STATUS_DEFAULT;
   }

   public function getStatusText($status)
   {
      $statuses = $this->getResource()->getStatusOptions();
      if (array_key_exists($this->status,$statuses)) {
         return $statuses[$this->status];
      }
      return $statuses[Model_Category_Resource::STATUS_DEFAULT];
   }

   public function __construct()
   {
      parent::__construct();

      $this->setResourceClass('Model_Category_Resource');
      $this->setCollectionClass('Model_Category_Collection');
   }

   public function getParentCategories()
	{
		$query = "SELECT `category_id`, `path` FROM `category`;";
		$categories = $this->getResource()->getAdapter()->fetchPairs($query);
		return $categories;
	}

	public function prePathCategories()
	{
		$category = Ccc::getModel('Category');
		$query = "SELECT `category_id`, `name` FROM `{$category->getResource()->getResourceName()}` ORDER BY `path` ASC";
		$categories = $category->getResource()->getAdapter()->fetchPairs($query);

		$sql = "SELECT `category_id`, `path` FROM `{$category->getResource()->getResourceName()}` ORDER BY `path` ASC";
		$pathCategory = $category->getResource()->getAdapter()->fetchPairs($sql);

		foreach ($pathCategory as $category_id => $path) {
			$string = explode('=', $path);
			$final = [];
			foreach ($string as $key => $category_id) {
				$final[$key] = $categories[$category_id];
			}
			$categoriesName[$category_id] = implode('>', $final);
		}
		return $categoriesName;
	}

	public function getPathCategories($category_id)
	{
		return $this->prePathCategories()[$category_id];
	}

	public function updatePath()
	{
		if (!$this->getId()) {
			return false;
		}

		$oldPath = $this->path;

		$parent = Ccc::getModel('Category')->load($this->parent_id);
		if (!$parent) {
			$this->path = $this->getId();
		}
		else{
			$this->path = $parent->path.'='.$this->getId();
		}

		$this->save();
		
		$query = "UPDATE `category`
		SET `path` = REPLACE(`path`, '{$oldPath}=', '{$this->path}=')
		WHERE `path` LIKE '{$oldPath}=%' ORDER BY `path` ASC ";
		$this->getResource()->getAdapter()->update($query);

		return $this;
	}
}
//http refrer means je url mathi aapade aaviya hoy te



