<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Encode_Html_Entities implements QFilter_Interface {
		private string $field_name;
		private string $format;
		
		public function __construct( string $field_name, string $format = ENT_QUOTES ) {
			$this -> field_name = $field_name;
			$this -> format = $format;
		}
		
		/**
		 * Encode an HTML entity, from $ to &#36; 
		 *
		 * @access			public
		 * @return			void
		 *
		 * @link			http://www.evotech.net/blog/2007/04/named-html-entities-in-numeric-order/
		 * @link			https://www.techiecorner.com/129/php-how-to-convert-iso-character-htmlentities-to-utf-8/
		 */
		 
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$dataspace -> set( $this -> field_name, htmlentities( $dataspace -> get( $this -> field_name ), $this -> format ) );
		}
	}
	
?>