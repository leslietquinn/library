<?php

	final class QValidator_Condition_Http_Referer extends QValidator_Condition {
		protected $secure_host;
		protected $field_name;
		protected $message;
		protected $host;
		
		public function __construct( $field_name, $host = '__baseuri', $secure_host = '__securebaseuri', $message = '.' ) {
			$this -> secure_host = $secure_host;
			$this -> field_name = $field_name;
			$this -> message = $message;
			$this -> host = $host;
		}
		
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			$host = parse_url( $dataspace -> get( $this -> host ) ); 
			$secure = parse_url( $dataspace -> get( $this -> secure_host ) ); 
			$package = parse_url( $dataspace -> get( $this -> field_name ) ); 
			
			if( !( $host['host'] == (string) $package['host'] ) && !( $secure['host'] == (string) $package['host'] ) ) {
				$logger -> set( $this -> field_name, $this -> message );
				return false;
			}
			return true;
		}
	}
	
?>