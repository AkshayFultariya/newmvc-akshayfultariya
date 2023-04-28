<?php

class Model_Core_Pager
{
	public $totalRecords = 0;
	public $currentPage = 0;
	public $recordPerPage = 10;
	public $numberOfPages = 0;
	public $start = 1;
	public $previous = 0;
	public $next = 0;
	public $end = 0;
	public $startLimit = 0;
    public $recordPerPageOptions = [10,20,50,100,200];

	public function  __construct()
	{
		$this->setCurrentPage();		
	}

    public function setCurrentPage()
    {
        $this->currentPage = (int)Ccc::getModel('Core_Request')->getParam("p",1);
        return $this;
    }	

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function setTotalRecords($totalRecords)
    {
        $this->totalRecords = $totalRecords;
        return $this;
    }

    public function getTotalRecords()
    {
        return $this->totalRecords;
    }

    public function getRecordPerPage()
    {
        return $this->recordPerPage;
    }

    public function setNumberOfPages($numberOfPages)
    {
        $this->numberOfPages = $numberOfPages;
        return $this;
    }

    public function getNumberOfPages()
    {
        return $this->numberOfPages;
    }

	public function calculate()
	{
        // print_r($this->getTotalRecords());
        // die();

        $numberOfPages = ceil($this->getTotalRecords()/$this->recordPerPage);
    
        $this->setNumberOfPages($numberOfPages);

        if ($this->getNumberOfPages() == 0) {
            $this->currentPage = 0;
        }

        if ($this->getNumberOfPages() == 1 || ($this->getNumberOfPages() > 1 && $this->getCurrentPage() <= 0)) {
            $this->currentPage = 1;
        }

        if ($this->currentPage > $this->getNumberOfPages()) {
            $this->currentPage = $this->getNumberOfPages();
        }

        $this->setStart(1);
        if (!$this->getNumberOfPages()) {
            $this->setStart(0);
        }
        if ($this->currentPage == 1) {
            $this->setStart(0);
        }

        $this->setEnd($this->getNumberOfPages());
        if ($this->getEnd() > $this->getNumberOfPages()) {
            $this->setEnd($this->getNumberOfPages());
        }

        $this->setPrevious(($this->getCurrentPage())-1);
        if (($this->getCurrentPage()) <= 1) {
            $this->getPrevious(0);
        }

        $this->setNext(($this->getCurrentPage())+1);
        if ($this->currentPage >= $this->getNumberOfPages()) {
            $this->setNext(0);
        }

        $this->setStartLimit(($this->getCurrentPage()-1)*($this->getRecordPerPage()));
	}

    public function setRecordPerPage($recordPerPage)
    {
        $this->recordPerPage = $recordPerPage;
        return $this;
    }


   
    public function getStart()
    {
        return $this->start;
    }

    public function setStart($start)
    {
        $this->start = $start;
        return $this;
    }

    public function getRecordPerPageOptions()
    {
        return $this->recordPerPageOptions;
    }

    public function setRecordPerPageOptions($recordPerPageOptions)
    {
        $this->recordPerPageOptions = $recordPerPageOptions;
        return $this;
    }

   
    public function getPrevious()
    {
        return $this->previous;
    }

    public function setPrevious($previous)
    {
        $this->previous = $previous;
        return $this;
    }

   
    public function getNext()
    {
        return $this->next;
    }

    public function setNext($next)
    {
        $this->next = $next;
        return $this;
    }

   
    public function getEnd()
    {
        return $this->end;
    }

    public function setEnd($end)
    {
        $this->end = $end;
        return $this;
    }

   
    public function getStartLimit()
    {
        return $this->startLimit;
    }

    public function setStartLimit($startLimit)
    {
        $this->startLimit = $startLimit;

        return $this;
    }
}    

