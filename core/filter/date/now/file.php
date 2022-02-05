<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Date_Now implements QFilter_Interface {
		private $field_name;
		
		/**
		 * Emulate now() function found in Mysql
		 *
		 * @param	$field_name			string
		 *
		 * @return			void
		 */
		 
		public function __construct( string $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			$dataspace -> set( $this -> field_name, QInterval_Date::timestamp() );
		}
	}
	
?>