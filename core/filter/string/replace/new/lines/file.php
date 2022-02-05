<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_String_Replace_New_Lines implements QFilter_Interface {
		private $field_name;
		private $source;
		
		public function __construct( $field_name, $source = '</p><p>' ) {
			$this -> field_name = $field_name;
			$this -> source = $source;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			// remove duplicate new lines first
			$dataspace -> set( $this -> field_name, str_replace( array( "\r\n\r\n", "\r\r", "\n\n" ), "\r\n", $dataspace -> get( $this -> field_name ) ) );
			$dataspace -> set( $this -> field_name, str_replace( array( "\r\n", "\r", "\n" ), $this -> source, $dataspace -> get( $this -> field_name ) ) );
		}
	}
	
?>