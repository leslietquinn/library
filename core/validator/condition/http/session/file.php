<?php
	
	final class QValidator_Condition_Http_Session extends QValidator_Condition {
		private $field_name;
		private $message;
		
		public function __construct( $field_name, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> message = $message;
		}
		
		/**
		 * A specified field name present or not in $_SESSION
		 *
		 * @param	$dataspace		object
		 * @param	$logger			object
		 * 
		 * @see 	./library/core/validator/condition/has/session/
		 *
		 * @access			public
		 * @return			boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			if( $dataspace -> get( 'session' ) -> has( $this -> field_name ) ) {
				return true;
			}
			
			$logger -> log( $this -> field_name, $this -> message );
			return false;
		}
	}
	
?>