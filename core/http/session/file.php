<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Session implements QDataspace_Interface {
		public function __construct() {}
		public function set() {
			$parameters = func_get_args();
			if( is_array( $parameters ) && count( $parameters ) ) {
				$_SESSION[strtolower( array_shift( $parameters ) )] = array_shift( $parameters );
			}
		}
		
		public function get() {
			$parameters = func_get_args();
			if( is_array( $parameters ) && count( $parameters ) ) {
				if( array_key_exists( $parameter = array_shift( $parameters ), (array) $_SESSION ) ) {
					return $_SESSION[$parameter];
				}
			}
			return false;
		}
		
		public function has() {
			$parameters = func_get_args();
			if( is_array( $parameters ) && count( $parameters ) ) {
				if( array_key_exists( $parameter = array_shift( $parameters ), (array) $_SESSION ) ) {  
					return true;
				}
			}
			return false;
		}
		
		/**
		 * Destroy whole session; have to destroy by individual keys
		 * 
		 * @param					array	
		 * @access					public
		 * @return					void
		 */
		 
		public function destroy() {
			$parameters = func_get_args(); 
			if( is_array( $parameters ) && count( $parameters ) ) {
				$parameter = array_shift( $parameters ); 
				if( array_key_exists( $parameter, $_SESSION ) ) {
					unset( $_SESSION[$parameter] );
				} 
			} else { 
				// destroy whole session
				foreach( array_keys( $_SESSION ) as $key ) {
					unset( $_SESSION[$key] );
				}
			} 
		}
	}
	
?>