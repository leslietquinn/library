<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_String_Pad implements QFilter_Interface {
		private $field_name;
		private $character;
		private $padding;
		
		/**
		 * Pad out a string by zero fill up to certain length
		 *
		 * @param	$field_name		string
		 * @param	$padding		int 		legnth to pad
		 * @param	$character		string		character to pad with
		 *
		 * @return					void
		 */
		 
		public function __construct( string $field_name, int $padding = 9, string $character = '0' ) {
			$this -> field_name = $field_name;
			$this -> character = $character;
			$this -> padding = $padding;
		}
		
		public function process() : void { 
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$dataspace -> set( $this -> field_name, str_pad( $dataspace -> get( $this -> field_name ), $this -> padding, $this -> character, STR_PAD_LEFT ) );
		}
	}
	
?>