<?php

	/**
	 * @package		filter
	 * @version		beta-05f, 06;09-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Formatter_Currency implements QFilter_Interface {
		private $alternate_name;
		private $field_name;
		
		/**
		 * 
		 *
		 * @param	$field_name			string
		 * @param	$alternate_name		string
		 *
		 * @return					void
		 */
		 
		public function __construct( $field_name, $alternate_name ) {
			$this -> alternate_name = $alternate_name;
			$this -> field_name = $field_name;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$formatter = new QInternationalisation_Formatter();
			
			$dataspace -> set( $this -> alternate_name, $formatter -> currency( $dataspace -> get( $this -> field_name ) ) );
			
		}
	}
	
?>