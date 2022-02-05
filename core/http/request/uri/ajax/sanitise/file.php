<?php

	final class QHttp_Request_Uri_Ajax_Sanitise implements QFilter_Interface {
		private $seperator = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$seperator			string			character to begin sanitisation from
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function __construct( $seperator = null ) {
			$this -> seperator = $seperator;
		}
	
		/**
		 * Clean up an AJAX request during a redirect by removing all characters after seperator
		 *
		 * @note		a problem existed whereby an addition variable was added to uri after 
		 *				an ajax response, this corrupted the uri for use with cache
		 *
		 *				discovered this was a problem on 17/01/14
		 *
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( $dataspace -> isAjax() ) { 
				if( isset( $_SERVER['REDIRECT_QUERY_STRING'] ) ) {
					$_SERVER['REDIRECT_QUERY_STRING'] = substr( $_SERVER['REDIRECT_QUERY_STRING'], 0, strpos( $_SERVER['REDIRECT_QUERY_STRING'], $this -> seperator ) );
					$_SERVER['REQUEST_URI'] = substr( $_SERVER['REQUEST_URI'], 0, strpos( $_SERVER['REQUEST_URI'], $this -> seperator ) );
				} 
				
				$_SERVER['QUERY_STRING'] = substr( $_SERVER['QUERY_STRING'], 0, strpos( $_SERVER['QUERY_STRING'], $this -> seperator ) );
			}
		}
	}
	
?>