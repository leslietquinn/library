<?php

	final class QProcess_Filter_Adapter implements QProcess_Filter_Interface {
		private $filter = null;
		
		public function __construct( QFilter_Interface $filter ) {
			$this -> filter = $filter;
		}
		
		public function preProcess() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$this -> filter -> process( $dataspace );
		}
		
		public function postProcess() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$this -> filter -> process( $dataspace );
		}
	}
	
?>