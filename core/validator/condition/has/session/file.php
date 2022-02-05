<?php

	final class QValidator_Condition_Has_Session extends QValidator_Condition {
		protected $field_name;
		protected $message;
		
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
		 * @see 	./library/core/validator/condition/http/session/
		 *
		 * @access			public
		 * @return			boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			$value = $dataspace -> get( 'session' ) -> get( $this -> field_name ); 
			if( empty( $value ) || !isset( $value ) ) { 
				$logger -> set( $this -> field_name, $this -> message ); 
				return false;
			}  
			
			return true;
		}
	}
	
?>