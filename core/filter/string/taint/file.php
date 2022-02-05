<?php

	final class QFilter_String_Taint implements QFilter_Interface {
		private $alternate_name;
		private $field_name;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 * @param	$alternate_name		string
		 *
		 * @access
		 *
		 * @return			void
		 */
		 
		public function __construct( string $field_name, string $alternate_name = null ) {
			$this -> alternate_name = $alternate_name;
			$this -> field_name = $field_name;
		}
		
		/**
		 */
		
		/**
		 * Generate a slug from a string, accounting for unicode characters
		 *
		 * @access			public
		 *
		 * @return			void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$use_name = $this -> field_name;
			if( $this -> alternate_name ) {
				// allow tainted string to be stored as another key
				$use_name = $this -> alternate_name; 
			}
			
			// "A Sample Word" now becomes "a-sample-word" suitable for url
			$dataspace -> set( $use_name, QInternationalisation_String::transliterate( $dataspace -> get( $this -> field_name ) ) );
		}
	}
	
?>