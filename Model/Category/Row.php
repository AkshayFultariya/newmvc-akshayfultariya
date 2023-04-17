<?php
class Model_Category_Row extends Model_Core_Table_Row
{
	function __construct()
	{
		parent::__construct();
		$this->setTableClass('Model_Category');
	}

	public function getStatus()
	{
		if ($this->status) {
			return $this->status;
		}

		return Model_Category::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getTable()->getStatusOptions();
		if (array_key_exists($this->status, $statuses)) {
			return $statuses[$this->status];
		}
		return $statuses[Model_Category::STATUS_DEFAULT];
	}

	public function getParentCategories()
	{
		$query = "SELECT `category_id`, `path` FROM `category`;";
		$categories = $this->getTable()->getAdapter()->fetchPairs($query);
		return $categories;
	}

	public function prePathCategories()
	{
		$category = Ccc::getModel('Category_Row');
		$query = "SELECT `category_id`, `name` FROM `{$category->getTable()->getTableName()}` ORDER BY `path` ASC";
		$categories = $category->getTable()->getAdapter()->fetchPairs($query);

		$sql = "SELECT `category_id`, `path` FROM `{$category->getTable()->getTableName()}` ORDER BY `path` ASC";
		$pathCategory = $category->getTable()->getAdapter()->fetchPairs($sql);

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

		$parent = Ccc::getModel('Category_Row')->load($this->parent_id);
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
		$this->getTable()->getAdapter()->update($query);

		return $this;
	}
}