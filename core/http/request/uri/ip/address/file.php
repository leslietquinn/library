<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Request_Uri_Ip_Address implements QFilter_Interface {
		public function __construct() {}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$parts = explode( '.', $this -> getIp() );
			
			$ips = array();
			foreach( $parts as $part ) {
				$ips[] = str_pad( $part, 3, '0', STR_PAD_LEFT );
			}
			
			$dataspace -> set( '__ipaddress', implode( '.', $ips ) );			
		}
		
		private function getIp() {
			$address = '127.0.0.1';
			
			if( array_key_exists( 'HTTP_X_FORWARDED_FOR', $_SERVER ) ) {
				if( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
					$address = $_SERVER['HTTP_X_FORWARDED_FOR'];
				}
			} elseif( array_key_exists( 'HTTP_CLIENT_IP', $_SERVER ) ) {
				if( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
					$address = $_SERVER['HTTP_CLIENT_IP'];
				}
			} else {
				if( isset( $_SERVER['REMOTE_ADDR'] ) ) {
					$address = $_SERVER['REMOTE_ADDR'];
				}
			}
			
			if( strstr( $address, ',' ) ) {
				return strtok( $address, ',' );
			}
			
			return $address;
		}
	}
	
?>