<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_String_Uppercase implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$dataspace -> set( $this -> field_name, strtoupper( $dataspace -> get( $this -> field_name ) ) );
		}
	}
	
?>