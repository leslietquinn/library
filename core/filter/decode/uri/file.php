<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Decode_Uri implements QFilter_Interface {
		private string $field_name;
		
		/**
		 * Class constructor
		 * 
		 * @param	$field_name 		string
		 * 
		 * @access			public
		 * @introduced		2022/01/21 [last modified]
		 * @return			void
		 */
		
		public function __construct( string $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * @see		./encoding/
		 */
		 
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$encoder = new QEncoding( $dataspace -> get( $this -> field_name ) );
			
			$dataspace -> set( $this -> field_name, $encoder -> fromUri() );
		}
	}
	
?>