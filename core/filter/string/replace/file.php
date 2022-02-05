<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_String_Replace implements QFilter_Interface {
		private $field_name;
		private $target;
		private $source;
		
		public function __construct( $field_name, $target, $source ) {
			$this -> field_name = $field_name;
			$this -> target = $target;
			$this -> source = $source;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$dataspace -> set( $this -> field_name, str_replace( $this -> target, $this -> source, $dataspace -> get( $this -> field_name ) ) );
		}
	}
	
?>