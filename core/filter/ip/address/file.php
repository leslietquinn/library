<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Ip_Address implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Preserve current IP address
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			$dataspace -> set( $this -> field_name, $dataspace -> get( '__ipaddress' ) );
		}
	}
	
?>