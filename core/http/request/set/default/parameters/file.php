<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Request_Set_Default_Parameters implements QFilter_Interface {
		/**
		 * Set default parameters if present, from an AJAX call
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function __construct() {}
		
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( $dataspace -> has( 'params' ) && $dataspace -> isAjax() ) {
				$chars = explode( '?', $dataspace -> get( 'params' ) );
				
				if( isset( $chars[0] ) ) { 
					$dataspace -> set( 'id', $chars[0] );
				}
				
				if( isset( $chars[1] ) ) { 
					$dataspace -> set( 'pager', $chars[1] );
				}
			}
		}
	}
	
?>