<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Http_Uri implements QFilter_Interface {
		private $field_name;
		private $option;
		
		/**
		 * Note, $option use
		 *
		 *		PHP_URL_SCHEME
		 *		PHP_URL_HOST
		 *		PHP_URL_PORT
		 *		PHP_URL_USER
		 *		PHP_URL_PASS
		 *		PHP_URL_PATH
		 *		PHP_URL_QUERY 
		 *		PHP_URL_FRAGMENT 
		 */
		 
		public function __construct( $field_name, $option ) { 
			$this -> field_name = $field_name;
			$this -> option = $option;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
		}
	}
	
?>