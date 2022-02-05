<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Request_Security_Hash_Reset implements QFilter_Interface {
		private $field_name;

		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 *
		 * @access				public
		 * @return				void
		 */

		public function __construct( string $field_name ) {
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
			
			$dataspace -> get( 'session' ) -> set( $this -> field_name, $token = QCommon::unique() );
			
			// keep a copy for request too
			$dataspace -> set( $this -> field_name, $token );
		}
	}
	
?>