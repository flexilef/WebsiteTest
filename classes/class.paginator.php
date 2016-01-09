<?php
	
	class Paginator {
	
		private $itemsPerPage; //numeric
		private $instance; //string
		private $currentPage; //numeric
		private $totalItems = 0; //numeric
		
		public function __construct($perPage, $getParam) {
			$this->itemsPerPage = $perPage;
			$this->instance = $getParam;
			
			$this->setInstance();
		}
		
		private function setInstance() {
			if(!isset($_GET[$this->instance])) {
				$this->currentPage = 1;
			}
			else {
				$this->currentPage = (int)($_GET[$this->instance]);
			}
			
			if($this->currentPage == 0)
				$this->currentPage = 1;
		}
		
		//ex. if on page 2 and itemsPerPage is 5, we start from 5 in our dataset
		public function getStart() {
			return ($this->currentPage * $this->itemsPerPage) - $this->itemsPerPage;
		}
		
		public function setTotalItems($totalRows) {
			$this->totalItems = $totalRows;
		}
		
		public function createLinks($path) {
			$prev = $this->currentPage - 1;
			$next = $this->currentPage + 1;
			
			if($this->itemsPerPage > 0)
				$lastPage = ceil($this->totalItems/$this->itemsPerPage);
			
			$penultativePage = $lastPage - 1;
			
			$pagination = "";
			if($lastPage > 1) {
				$pagination.= '<ul class="pagination">';
			
				//prev link
				if($prev > 0)
					$pagination.= "<li><a href=\"" . $path . "$this->instance=$prev\"" . ">Previous</a></li>";
				else
					$pagination.= "<li class=\"disabled\"><span>Previous</span></li>";
					
				//numbered links
				for($counter = 1; $counter <= $lastPage; $counter++) {
					if($counter == $this->currentPage)
						$pagination.= "<li class=\"active\"><a href=\"" . $path . "$this->instance=$counter\"" . ">$counter</a></li>";
					else
						$pagination.= "<li><a href=\"" . $path . "$this->instance=$counter\"" . ">$counter</a></li>";
				}
				
				//next link
				if($next <= $lastPage)
					$pagination.= "<li><a href=\"" . $path . "$this->instance=$next\"" . ">Next</a></li>";
				else
					$pagination.= "<li class=\"disabled\"><span>Next</span></li>";
					
				$pagination.= '</ul>';
			}
			
			return $pagination;
		}
	}
	
?>