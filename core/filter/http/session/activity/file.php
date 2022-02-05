<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 *
	 * @deprecated		15/07/2021
	 * @see				QHttp_Request_Session_Destroy
	 */
	 
	final class QFilter_Http_Session_Activity implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name, $option = 1800 ) { 
			$this -> field_name = $field_name;
			$this -> option = $option;
		}
		
		/**
		 * Improve security of session, stop session fixation by generating a new ID more frequently
		 *
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			if( !$dataspace -> get( 'session' ) -> has( $this -> field_name ) ) {
				$dataspace -> get( 'session' ) -> set( $this -> field_name, time() );
			}
			
			if( $dataspace -> get( 'session' ) -> get( $this -> field_name ) - time() > $this -> option ) {
				session_regenerate_id( true );    
    
				$dataspace -> get( 'session' ) -> set( $this -> field_name, time() );
			}
		}
	}
	
?>