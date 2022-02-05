<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_String_Trim_Array implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$trimmed = array();
			$array = $dataspace -> get( $this -> field_name );
			
			foreach( $array as $key ) {
				$trimmed[] = trim( $key );
			} 
			
			$dataspace -> set( $this -> field_name, $trimmed );
		}
	}
	
?>