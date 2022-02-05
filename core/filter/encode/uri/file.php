<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Encode_Uri implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * @see		./encoding/
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$encoder = new QEncoding( $dataspace -> get( $this -> field_name ) );
			
			$dataspace -> set( $this -> field_name, $encoder -> toUri() );
		}
	}
	
?>