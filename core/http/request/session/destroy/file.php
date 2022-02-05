<?php

	final class QHttp_Request_Session_Destroy implements QFilter_Interface {
		private $field_name;
		
		public function __construct( string $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			$session = $dataspace -> get( 'session' );
			if( !$session -> has( $this -> field_name ) ) {
				$session -> set( $this -> field_name, time() ); 
			}
			
			if( $session -> has( $this -> field_name ) ) { 
				$time  = time() - $session -> get( $this -> field_name );
				
				$session = QRegistry::get( 'configuration' ) -> get( 'session' ); 

				/**
				 * @todo	- 2022/01/16
				 * 
				 * 			sanity check on $session, be sure it is an array
				 */
				
				if( $time > $session['duration'] ) {
					// if time to live is greater then $duration minus time() then destroy session
					session_unset();  
					session_destroy(); 
				}
			}
		}
	}
	
?>