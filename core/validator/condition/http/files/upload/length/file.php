<?php

	final class QValidator_Condition_Http_Files_Upload_Length extends QValidator_Condition {
		private $field_name;
		private $message;
		private $length;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name		string
		 * @param	$filetypes		array
		 * @param	$message		string
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function __construct( $field_name, $length, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> message = $message;
			$this -> length = $length;
		}
		
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			if( (int) $dataspace -> get( $this -> field_name ) -> get( 'size' ) > $this -> length ) {
				$logger -> set( $this -> field_name, $this -> message );
				return false;
			}
			
			return true;
		}
	}
	
?>