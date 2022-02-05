<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Request_Uri_Preserve implements QFilter_Interface {
		private $field_name;
		
		public function __construct( string $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			/**
			 * @note	the following is the Javascript equivalent to this
			 *			function
			 *
			 *			- window.location.href.toString().split( window.location.host )[1]
			 *
			 */
			 
			if( isset( $_SERVER['REQUEST_URI'] ) ) {
				$dataspace -> set( $this -> field_name, $_SERVER['REQUEST_URI'] );
			}
		}
	}
	
?>