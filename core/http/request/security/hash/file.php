<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Request_Security_Hash implements QFilter_Interface {
		private $field_name;

		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 *
		 * @access				public
		 * @return				void
		 */

		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Apply implementation on dataspace
		 *
		 * @access				public
		 * @return				void
		 */

		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( !$dataspace -> get( 'session' ) -> has( $this -> field_name ) ) {
				$token = QCommon::unique(); 
				
				// initialise token first time
				$dataspace -> get( 'session' ) -> set( $this -> field_name, $token );
			}

			// keep a copy for request too
			$dataspace -> set( $this -> field_name, $dataspace -> get( 'session' ) -> get( $this -> field_name ) );
		}
	}
	
?>