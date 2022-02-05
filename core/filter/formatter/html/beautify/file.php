<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Formatter_Html_Beautify implements QFilter_Interface {
		private $field_name;
		
		/**
		 * Format a string with proper indentation for HTML output 
		 *
		 * @see http://gdatatips.blogspot.co.uk/2008/11/xml-php-pretty-printer.html
		 */
		 
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$dataspace -> set( $this -> field_name, $this -> format( $dataspace -> get( $this -> field_name ) ) );
		}
		
		private function format( $xml ) {
			$level = 4;
			$indent = 0; 
			$pretty = array();
			
			$xml = explode( "\n", preg_replace( '/>\s*</', ">\n<", $xml ) );

			if( count( $xml ) && preg_match( '/^<\?\s*xml/', $xml[0] ) ) {
				$pretty[] = array_shift( $xml );
			}

			foreach( $xml as $el ) {
				if( preg_match( '/^<([\w])+[^>\/]*>$/U', $el ) ) {
					$pretty[] = str_repeat( ' ', $indent ) . $el;
					$indent += $level;
				} else {
					if( preg_match( '/^<\/.+>$/', $el ) ) {            
						$indent -= $level; 
					}
					
					if( $indent < 0 ) {
						$indent += $level;
					}
				
					$pretty[] = str_repeat( ' ', $indent ) . $el;
				}
			}   
    
			$xml = implode( "\n", $pretty );   
    
			return $xml;
		}
		
	}
	
?>