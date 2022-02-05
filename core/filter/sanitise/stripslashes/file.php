<?php

	final class QFilter_Sanitise_Stripslashes implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Strip escaped quotes on string
		 *
		 * @see		./sanitise/
		 *
		 * @access						public
		 * @return						void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$sanitiser = new QSanitise( $dataspace -> get( $this -> field_name ) );
			
			$dataspace -> set( $this -> field_name, $sanitiser -> stripslashes() );
		}
	}
	
?>