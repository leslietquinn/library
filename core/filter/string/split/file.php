<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 * @ignore
	 */
	 
	final class QFilter_String_Split implements QFilter_Interface {
		private $field_name;
		private $separator;
		private $range;
		
		/**
		 * Split a string into an array
		 *
		 * @param	$field_name		string
		 * @param	$range			mixed	
		 * @param	$separator		mixed	used to split string
		 *
		 * @return					void
		 */
		 
		public function __construct( $field_name, $range, $separator ) {
			$this -> field_name = $field_name;
			$this -> separator = $separator;
			$this -> range = $range;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$range = explode( $this -> separator, $dataspace -> get( $this -> field_name ) );
			
			if( is_array( $this -> range ) ) {
				// set array indexes as per key found
				foreach( $this -> range as $key ) {
					$dataspace -> set( $key, array_shift( $range ) );
				}
			} else {
				// store array as is
				$dataspace -> set( $this -> range, $range );
			}
		}
	}
	
?>