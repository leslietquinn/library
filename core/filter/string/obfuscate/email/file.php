<?php

	final class QFilter_String_Obfuscate_Email implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			$dataspace -> set( $this -> field_name, $this -> obfuscate( $dataspace -> get( $this -> field_name ) ) ); 
		}
		
		private function obfuscate( $target ) { 
			$obfuscate = '';
			for( $a = 0, $b = strlen( $target ); $a < $b; $a++ ) {
				$obfuscate .= '&#'.( mt_rand( 0, 1 ) == 0  ? 'x'.dechex( ord( $target[$a] ) ) : ord( $target[$a] ) ).';';
			}

			return $obfuscate;
		}
	}
	
?>
