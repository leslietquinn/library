<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 * @ignore
	 */
	 
	final class QFilter_String_Split_To_Array implements QFilter_Interface {
		private $alternate_name;
		private $field_name;
		private $separator;
		
		/**
		 * Split a string into an array of indexes of type QDataspace_Interface
		 *
		 * @param	$field_name			string
		 * @param	$alternate_name		string	
		 * @param	$separator			string	used to split string
		 *
		 * @return					void
		 */
		 
		public function __construct( $field_name, $alternate_name, $separator ) {
			$this -> alternate_name = $alternate_name;
			$this -> field_name = $field_name;
			$this -> separator = $separator;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$parts = explode( $this -> separator, $dataspace -> get( $this -> field_name ) );
			
			$array = array();
			foreach( $parts as $part ) {
				$array[] = new QParameters( array( 'point' => $part ) );
			}
			
			$dataspace -> import( new QParameters( array( $this -> alternate_name => $array ) ) );
				
		}
	}
	
?>