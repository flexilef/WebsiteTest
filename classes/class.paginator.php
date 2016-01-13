<?php
	
	class Paginator {
	
		private $itemsPerPage; //numeric		
		private $totalItems = 0; //numeric
		private $instance; //string
		private $currentPage; //numeric
		
		public function __construct($perPage, $GETParam) {
			$this->itemsPerPage = $perPage;
			$this->instance = $GETParam;
			
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
		
		/*
		Returns the number of items offset between current page and the first page
		ex. if we're on page 3 and itemsPerPage is 4, we offset by 9 items to reach
		the first item on current page
		*/
		public function getItemsOffset() {
			return ($this->currentPage * $this->itemsPerPage) - $this->itemsPerPage;
		}
		
		public function setTotalItems($totalRows) {
			$this->totalItems = $totalRows;
		}
		
		/*
		Returns the HTML that creates the list of links
		$path specifies the path where the page links will reside
		$defaultCount specifies how many links to display after and before the first
			and last page, respectively (inclusive)
		$adjacentCount specifies how many links to display on either side of the current link
		*/
		public function createLinks($path, $defaultCount, $adjacentCount) {
			$prevLink = $this->currentPage - 1;
			$nextLink = $this->currentPage + 1;
			
			if($this->itemsPerPage > 0)
				$lastPage = ceil($this->totalItems/$this->itemsPerPage);
						
			$currentPage = $this->currentPage;
			$penultativePage = $lastPage - 1;
			
			$pagination = "";
			if($lastPage > 1) {
				//start list
				$pagination.= '<ul class="pagination">';
			
				//prev link
				if($prevLink > 0)
					$pagination.= "<li><a href=\"" . $path . "$this->instance=$prevLink\"" . ">Previous</a></li>";
				else
					$pagination.= "<li class=\"disabled\"><span>Previous</span></li>";
				
				$numDefaultLinksPerSide = $defaultCount;				
				$numAdjacentLinks = $adjacentCount;
				
				//if there are enough pages to display using the following rules
				if($lastPage > (($numDefaultLinksPerSide*2)+($numAdjacentLinks*2+1))) {
				
					//***first $numDefaultLinksPerSide links***
					for($counter = 1; $counter <= $numDefaultLinksPerSide; $counter++) {
						$pagination.= "<li><a href=\"" . $path . "$this->instance=$counter\"" . ">$counter</a></li>";
					}
					
					//***middle links***
					//if $currentPage has enough buffer on both sides to display its adjacent links
					if($currentPage > $numDefaultLinksPerSide+$numAdjacentLinks &&
							$currentPage <= $lastPage-($numDefaultLinksPerSide+$numAdjacentLinks)) {
						
						//if $currentPage's adjacent links skip earlier links, add "..."
						if($currentPage > $numAdjacentLinks+$numDefaultLinksPerSide+1)
						{
							$pagination.= "<li><span>...</span></li>";
						}
						
						//current page links and adjacents
						for($counter = $currentPage-$numAdjacentLinks; $counter <= $currentPage+$numAdjacentLinks; $counter++) {
							$pagination.= "<li><a href=\"" . $path . "$this->instance=$counter\"" . ">$counter</a></li>";
						}
						
						//if $currentPage's adjacent links skip later links, add "..."
						if($lastPage - $currentPage > $numAdjacentLinks+$numDefaultLinksPerSide)
						{
							$pagination.= "<li><span>...</span></li>";
						}
					}
					//not enough buffer on the left side
					else if($currentPage <= $numDefaultLinksPerSide+$numAdjacentLinks) {
						$numOverlappepLinks = abs($currentPage-$numDefaultLinksPerSide-$numAdjacentLinks-1);
						
						for($counter=$numDefaultLinksPerSide+1; $counter<=$currentPage+$numAdjacentLinks+$numOverlappepLinks; $counter++) {
							$pagination.= "<li><a href=\"" . $path . "$this->instance=$counter\"" . ">$counter</a></li>";
						}
						
						$pagination.= "<li><span>...</span></li>";
					}
					//not enough buffer on the right side
					else if($currentPage > $lastPage-($numDefaultLinksPerSide+$numAdjacentLinks)) {
						$numOverlappepLinks = abs($lastPage-$currentPage-$numDefaultLinksPerSide-$numAdjacentLinks);
						
						$pagination.= "<li><span>...</span></li>";

						for($counter=$currentPage-$numAdjacentLinks-$numOverlappepLinks; $counter<=$lastPage-$numDefaultLinksPerSide; $counter++) {
							$pagination.= "<li><a href=\"" . $path . "$this->instance=$counter\"" . ">$counter</a></li>";
						}
					}

					//***last $numDefaultLinksPerSide links***
					for($counter = $lastPage-$numDefaultLinksPerSide+1; $counter <= $lastPage; $counter++)
					{
						$pagination.= "<li><a href=\"" . $path . "$this->instance=$counter\"" . ">$counter</a></li>";
					}
				}
				//not enough pages? then just display all we have with no special rules
				else {
					for($counter = 1; $counter <= $lastPage; $counter++) {
						if($counter == $this->currentPage) {
							$pagination.= "<li class=\"active\"><span>$counter</span></li>";
						}
						else {
							$pagination.= "<li><a href=\"" . $path . "$this->instance=$counter\"" . ">$counter</a></li>";
						}
					}
				}
				
				//next link
				if($nextLink <= $lastPage)
					$pagination.= "<li><a href=\"" . $path . "$this->instance=$nextLink\"" . ">Next</a></li>";
				else
					$pagination.= "<li class=\"disabled\"><span>Next</span></li>";
				
				//end list
				$pagination.= '</ul>';
			}
			
			return $pagination;
		}
	}
	
?>