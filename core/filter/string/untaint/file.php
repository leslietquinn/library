<?php

	final class QFilter_String_Untaint implements QFilter_Interface {
		private $alternate_name;
		private $field_name;
		
		public function __construct( $field_name, $alternate_name = false ) {
			$this -> alternate_name = $alternate_name;
			$this -> field_name = $field_name;
		}
		
		/**
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$field_name = $this -> field_name;
			if( $this -> alternate_name ) {
				$field_name = $this -> alternate_name;
			}
			
			// "a-sample-word" now becomes "A Sample Word"
			$dataspace -> set( $field_name, ucwords( str_replace( '-', ' ', $dataspace -> get( $this -> field_name ) ) ) );
		}
	}
	
?>