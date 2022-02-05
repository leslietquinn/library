<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Request_Uri_Ua implements QFilter_Interface {
		public function __construct() {}
		
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
				$dataspace -> set( '__useragent', $_SERVER['HTTP_USER_AGENT'] );
			}
		}
	}
	
?>