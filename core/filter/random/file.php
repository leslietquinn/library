<?php

	/**
	 * @package		filter
	 * @version		beta-05f, 06;09-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Random implements QFilter_Interface {
		private $field_name;
		private $length;
		private $method;
		
		/**
		 * Create random string up to a certain length
		 *
		 * @param	$field_name		string
		 * @param	$length			integer		length of string
		 * @param	$method			string		method to call [
		 *										numeric 	(characters 0-9)
		 *										random 		(characters A-Z)
		 *										unique 		(characters a-z, A-Z, 0-9)
		 *										]
		 *
		 * @return					void
		 */
		 
		public function __construct( $field_name, $length, $method = 'numeric' ) {
			$this -> field_name = $field_name;
			$this -> length = $length;
			$this -> method = $method;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( in_array( $this -> method, array( 'numeric', 'random', 'unique' ) ) ) {
				$method = $this -> method;
				$dataspace -> set( $this -> field_name, QRandom::$method( $this -> length ) );
			}
		}
	}
	
?>