<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	
	final class QHttp_Cookie {
		public function __construct() {}
		
		final static public function set( $name, $value, $duration, $path = '/', $domain = false, $secure = false, $http_only = true ) {
			setcookie( strtolower( $name ), $value, time() + $duration, $path, $domain, $secure, $http_only );
		}
		
		final static public function has( $name ) {
			if( isset( $_COOKIE[strtolower( $name )] ) ) {
				return true;
			}
			
			return false;
		}
		
		final static public function get( $name ) {
			if( isset( $_COOKIE[strtolower( $name )] ) ) {
				return $_COOKIE[strtolower( $name )];
			}
			
			return false;
		}
		
		final static public function remove( $name ) {
			setcookie( strtolower( $name ), '', time() - QDate::YEAR );
		}
		
	}
	
?>