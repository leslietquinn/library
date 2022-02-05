<?php

	/**
	 * @package		filter
	 * @version		beta-07e, 13;14-dev
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Sanitise_Html_Entities implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Sanitise string by cleaning [removing] all HTML tag(s)
		 *
		 * @see		./sanitise/
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$input = $dataspace -> get( $this -> field_name );
			
			
			$output = preg_replace_callback( '/(&#[0-9]+;)/', 
				function( $m ) { 
					return mb_convert_encoding( $m[1], 'UTF-8', 'HTML-ENTITIES' ); 
				}, $input
			);
			
			$dataspace -> set( $this -> field_name, $output );
		}
	}
	
?>