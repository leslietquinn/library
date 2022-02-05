<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Set_If_Equals implements QFilter_Interface {
		private $replace_with;
		private $field_value;
		private $field_name;
		
		public function __construct( $field_name, $field_value, $replace_with ) {
			$this -> replace_with = $replace_with;
			$this -> field_value = $field_value;
			$this -> field_name = $field_name;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( $dataspace -> get( $this -> field_name ) == $this -> field_value ) {
				$dataspace -> set( $this -> field_name, $this -> replace_with );
			}
		}
	}
	
?>