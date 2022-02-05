<?php

	final class QFilter_String_Crop implements QFilter_Interface {
		private $field_name;
		private $ending;
		private $length;
		
		public function __construct( $field_name, $length, $ending = '...' ) {
			$this -> field_name = $field_name;
			$this -> ending = $ending;
			$this -> length = $length;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$dataspace -> set( $this -> field_name, $this -> downsize( $dataspace -> get( $this -> field_name ), $this -> length, $this -> ending ) );
		}
		
		private function downsize( $string, $length, $ending ) { 
			if( strlen( $string ) > $length ) {
  				$words = explode( ' ', $string );
  				$output = '';
  				$i = 0;
				
  				while( 1 ) {
   					$size = ( strlen( $output ) + strlen( $words[$i] ) );
   					if( $size > $length ) {
    					break;
   					} else {
    					$output = $output.' '.$words[$i];
    					++$i;
   					}
  				}
 			} else { 
  				$output = $string;
 			}
			
 			return $output.$ending;
		}
	}
	
?>