<?php

	class QFilter extends QDataspace implements QFilter_Interface {
		protected $filters = array();
		
		/**
		 * Class constructor
		 * 
		 * @access			public
		 * @introduced		2022/01/21 [last modified]
		 * @return			void
		 */

		public function __construct() {
			$this -> filters = array();
		}
		
		/**
		 * Add a filter
		 * 
		 * @param 	$filter 		object typeof QFilter_Interface 
		 * 
		 * @access			public
		 * @introduced		2022/01/21 [last modified]
		 * @return			object typeof QFilter_Interface
		 */

		public function addFilter( QFilter_Interface $filter ) : QFilter_Interface {
			if( !is_array( $this -> filters ) ) {
				$this -> filters = array();
			}
			
			$this -> filters[] = $filter;
			return $this;
		}
		
		public function process() {
			foreach( $this -> filters as $filter ) {
				$filter -> process( $this );
			}
			
			$this -> filters = array();
		}
	}
	
?>