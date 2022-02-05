<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Set_If_Empty implements QFilter_Interface {
		private $field_value;
		private $field_name;
		
		public function __construct( $field_name, $field_value ) {
			$this -> field_value = $field_value;
			$this -> field_name = $field_name;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$field = (string) $dataspace -> get( $this -> field_name );
			
			if( empty( $field ) || strlen( $field ) == 0  || ( $field == '0.00' || $field == '0000-00-00' || $field == '0000-00-00 00:00:00' ) ) {
				$dataspace -> set( $this -> field_name, $this -> field_value );
			}
		}
	}
	
?>