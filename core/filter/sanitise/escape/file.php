<?php

	/**
	 * @package		filter
	 * @version		beta-07e, 13;14-dev
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Sanitise_Escape implements QFilter_Interface {
		private $field_name;
		private $encoding;
		private $quote;
		
		public function __construct( string $field_name, string $quote, string $encoding = 'UTF-8' ) {
			$this -> field_name = $field_name;
			$this -> encoding = $encoding;
			$this -> quote = $quote;
		}
		
		/**
		 * Sanitise string by escaping special characters
		 *
		 * @see		QSanitise::escape();
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$sanitiser = new QSanitise( $dataspace -> get( $this -> field_name ) );
			$dataspace -> set( $this -> field_name, $sanitiser -> escape( $this -> quote, $this -> encoding ) );
		}
	}
	
?>