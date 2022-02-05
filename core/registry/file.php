<?php

	/**
	 * @package		none
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QRegistry {
		private static $registry = array();
		
		private function __construct() {}
		
		static public function get() {
			$parameters = func_get_args();
			if( is_array( $parameters ) ) {
				if( array_key_exists( $parameter = array_shift( $parameters ), self::$registry ) ) {
					return self::$registry[$parameter];
				}
			}
			return false;
		}
		
		static public function set() {
			$parameters = func_get_args();
			if( is_array( $parameters ) ) {
				$parameter = strtolower( array_shift( $parameters ) );
				if( !array_key_exists( $parameter, self::$registry ) ) {
					self::$registry[$parameter] = array_shift( $parameters );
				}
			}
		}
		
		static public function has() {
			$parameters = func_get_args();
			if( is_array( $parameters ) ) {
				if( array_key_exists( $parameter = array_shift( $parameters ), self::$registry ) && !empty( self::$registry[$parameter] ) ) {
					return true;
				}
			}
			return false;
		}
	}
	
?>