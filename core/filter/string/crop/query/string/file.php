<?php

	final class QFilter_String_Crop_Query_String implements QFilter_Interface {
		private $alternate_field;
		private $field_name;
		
		public function __construct( $field_name, $alternate_field = false ) {
			$this -> alternate_field = $alternate_field;
			$this -> field_name = $field_name;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$use_this = $this -> field_name;
			if( $this -> alternate_name ) {
				$use_this = $this -> alternate_field;
			}
			
			$dataspace -> set( $use_this, preg_replace( QExpressions::QUERY_STRING, '', $dataspace -> get( $this -> field_name ) ) );
		}
	}
	
?>