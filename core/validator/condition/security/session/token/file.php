<?php

	final class QValidator_Condition_Security_Session_Token extends QValidator_Condition {
		protected $field_name;
		protected $message;
		protected $token;
		
		/**
		 * Compare the hash in POST data against the hash in session for positive match
		 *
		 * @param	$field_name			string		hash found in POST data
		 * @param	$message			string		error message 
		 *
		 * @access						public
		 * @return						void
		 */
		 
		public function __construct( $field_name, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> message = $message;
		}
		
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			if( $dataspace -> get( $this -> field_name ) == $dataspace -> get( 'session' ) -> get( $this -> field_name ) ) {
				return true;
			}

			$logger -> set( $this -> field_name, $this -> message );
			return false;
		}
	}
	
?>