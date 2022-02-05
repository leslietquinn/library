<?php

	final class QFilter_Magic_Quotes implements QFilter_Interface {
		public function __construct() {}
		
		/**
		 * Sanitise (strip slashes) GET, POST & COOKIE if present
		 *
		 * @access						public
		 * @return						void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( ini_get( 'magic_quotes_gpc' ) == 1 ) {
				$dataspace -> import( new QParameters( $this -> clean( $dataspace -> export() ) ) );
			}			
		}
		
		/**
		 * Perform actual stripping slashes
		 *
		 * @see		./sanitise/
		 *
		 * @access						private
		 * @return						mixed		string|array
		 */
		 
		private function clean( $parameters ) {
			$temp = array();
			if( is_array( $parameters ) ) {
				foreach( $parameters as $k => $v ) {
					if( is_array( $v ) ) {
						$temp[$k] = $this -> clean( $v );
					} 
					
					if( is_string( $v ) ) {
						$temp[$k] = stripslashes( $v );
					}
				}
			} else {
				$temp = stripslashes( $parameters );
			}
			
			return $temp;
		}
	}
	
?>