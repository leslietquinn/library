<?php

	/**
	 * @deprecated	2021/12/20
	 * @see		QFront_Controller_Plugins_Filters_Session_Hash
	 */
	 
	final class QFilter_Http_Session_Hash implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Validate that a session hash exists otherwise destroy session and create a new one
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			if( !( $dataspace -> get( 'session' ) -> has( $this -> field_name ) ) ) { 
				$dataspace -> get( 'session' ) -> set( $this -> field_name, $dataspace -> get( '__nonce' ) );
			}
		}
	}
	
?>