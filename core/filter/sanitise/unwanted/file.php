<?php

	/**
	 * @package		filter
	 * @version		beta-07e, 13;14-dev
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Sanitise_Unwanted implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name, $pattern ) {
			$this -> field_name = $field_name;
			$this -> pattern = $pattern;
		}
		
		/**
		 * Sanitise string by cleaning [removing] all unwanted characters
		 *
		 * @see		./sanitise/
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$sanitiser = new QSanitise( $dataspace -> get( $this -> field_name ) );
			
			$dataspace -> set( $this -> field_name, $sanitiser -> unwanted( $this -> pattern ) );
		}
	}
	
?>