<?php

	final class QValidator_Condition_Http_Files_Upload_Mimetypes extends QValidator_Condition {
		private $field_name;
		private $mimetypes;
		private $message;
		
		public function __construct( $field_name, $mimetypes, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> mimetypes = $mimetypes;
			$this -> message = $message;
		}
		
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			if( !preg_match( $this -> mimetypes, (string) $dataspace -> get( $this -> field_name ) -> get( 'type' ) ) ) {
				$logger -> set( $this -> field_name, $this -> message );
				return false;
			}
			
			return true;
		}
	}
	
?>