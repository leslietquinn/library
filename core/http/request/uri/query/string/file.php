<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;21-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Request_Uri_Query_String implements QFilter_Interface {
		private $field_name;
		
		public function __construct( string $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			if( isset( $_SERVER['QUERY_STRING'] ) ) {
				$dataspace -> set( $this -> field_name, $_SERVER['QUERY_STRING'] );
			}
		}
	}
	
?>