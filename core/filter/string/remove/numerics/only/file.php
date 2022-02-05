<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 *
	 */
	 
	final class QFilter_String_Remove_Numerics_Only implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Remove numerical characters, accounting for non Latin characters
		 *
		 * @see 	https://stackoverflow.com/questions/14236148/how-to-remove-all-numbers-from-string
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$rs = preg_replace( '/\d+/u', '', $dataspace -> get( $this -> field_name ) ); 
			
			$dataspace -> set( $this -> field_name, $rs );
		}
	}
	
?>