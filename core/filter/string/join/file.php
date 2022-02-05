<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 * @ignore
	 */
	 
	final class QFilter_String_Join implements QFilter_Interface {
		private $field_name;
		private $separator;
		private $range;
		
		/**
		 * Create string from multiple array indexes
		 *
		 * @param	$field_name		string
		 * @param	$range			array		
		 * @param	$separator		mixed		separate words
		 *
		 * @return					void
		 */
		 
		public function __construct( string $field_name, array $range, string $separator ) {
			$this -> field_name = $field_name;
			$this -> separator = $separator;
			$this -> range = $range;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$range = $this -> range; 
			
			$r = array();
			foreach( $range as $key ) {
				$value = $dataspace -> get( $key );
				if( ( !empty( $value ) ) && ( strlen( $value ) > 0 ) ) {
					$r[] = $value;
				}
			}
			
			if( count( $r ) ) {
				$range = implode( $this -> separator, $r ); 
				$dataspace -> set( $this -> field_name, $range );
			}
		}
	}
	
?>