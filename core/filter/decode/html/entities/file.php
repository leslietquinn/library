<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Decode_Html_Entities implements QFilter_Interface {
		private string $field_name;
		private string $encoding;
		private string $format;
		
		/**
		 * Class constructor
		 * 
		 * @param	$field_name				string
		 * @param	$format					string [ENT_COMPAT, ENT_QUOTES, ENT_NOQUOTES, ENT_SUBSTITUTE]
		 * @param	$encoding				string
		 * 
		 * @see 	https://www.php.net/manual/en/function.html-entity-decode.php
		 * 
		 * @access			public
		 * @introduced		2022/02/07 [last modified]
		 * @return			void
		 */

		public function __construct( string $field_name, string $format, string $encoding = 'UTF-8' ) {
			$this -> field_name = $field_name;
			$this -> encoding = $encoding;
			$this -> format = $format;
		}
		
		/**
		 * Decode an HTML encoded entity, decode &#36; converts to $ for output
		 *
		 * @access			public
		 * @return			void
		 *
		 * @link			http://www.evotech.net/blog/2007/04/named-html-entities-in-numeric-order/
		 * @link			https://www.techiecorner.com/129/php-how-to-convert-iso-character-htmlentities-to-utf-8/
		 * @link			https://stackoverflow.com/questions/140728/best-practices-in-php-and-mysql-with-international-strings
		 * @link			https://stackoverflow.com/questions/6452720/htmlentities-makes-chinese-characters-unusable
		 */
		 
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$dataspace -> set( $this -> field_name, html_entity_decode( $dataspace -> get( $this -> field_name ), $this -> format, $this -> encoding ) );
		}
	}
	
?>