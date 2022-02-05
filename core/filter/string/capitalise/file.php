<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 *
	 */
	 
	final class QFilter_String_Capitalise implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Capitalise all words bound by unicode and utf8
		 *
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			$dataspace -> set( $this -> field_name, mb_convert_case( $dataspace -> get( $this -> field_name ), MB_CASE_TITLE, 'UTF-8' ) );
		}
	}
	
		/* @see		http://stackoverflow.com/questions/21062983/php-capitilise-abbrev-between-brackets-reg-exp
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$string = preg_replace_callback( '~\b([a-z])~', function ( $matches ) {
				return ucfirst( $matches[1] );
			}, strtolower( $dataspace -> get( $this -> field_name ) ) ); 
	
			// add exceptions on 21/09/14
			$words = explode( ' ', $string ); 
			
			$string = '';
			foreach( $words as $word ) { 
				if( in_array( $word, $this -> exceptions ) ) { 
					$word = strtolower( $word ); 
				} 
				
				$string .= $word.' ';
			}
			
			$dataspace -> set( $this -> field_name, rtrim( ucfirst( $string ) ) );
		} 
		*/ // echo str_replace( '( ', '(', ucwords( str_replace( '(', '( ', strtolower( $unformatted_words ) ) );
	
?>