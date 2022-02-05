<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Set_Default_On_Condition implements QFilter_Interface {
		private $field_name;
		private $not_empty;
		private $is_empty;
		
		public function __construct( $field_name, $is_empty, $not_empty ) {
			$this -> field_name = $field_name;
			$this -> not_empty = $not_empty;
			$this -> is_empty = $is_empty;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( !$dataspace -> has( $this -> field_name ) ) {
				$dataspace -> set( $this -> field_name, $this -> is_empty );
			} else {
				$dataspace -> set( $this -> field_name, $this -> not_empty );
			}
		}
	}
	
?>