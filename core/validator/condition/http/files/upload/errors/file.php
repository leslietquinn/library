<?php

	final class QValidator_Condition_Http_Files_Upload_Errors extends QValidator_Condition {
		private $field_name;
		
		public function __construct( $field_name, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> message = $message;
		}
		
		/**
		 * Determine if a value is valid or not, against a rule or condition
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 * @param	$logger				object
		 *
		 * @access				public
		 * @return				bool
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) : bool {
			if( $dataspace -> get( $this -> field_name ) -> has( 'erro' ) ) {
				if( $dataspace -> get( $this -> field_name ) -> get( 'erro' ) == 0 ) {
					return false;
				}
			}
			
			$logger -> set( $this -> field_name, $this -> message );
			
			return true;
		}
	}
	
?>