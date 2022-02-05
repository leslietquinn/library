<?php

	final class QValidator_Condition_Required extends QValidator_Condition {
		protected $field_name;
		protected $message;
		
		public function __construct( $field_name, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> message = $message;
		}
		
		/**
		 * A specified field name is required
		 *
		 * @param	$dataspace		object
		 * @param	$logger			object
		 *
		 * @access			public
		 * @return			boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			$value = $dataspace -> get( $this -> field_name ); 
			if( empty( $value ) || !isset( $value ) ) {
				$logger -> set( $this -> field_name, $this -> message ); 
				return false;
			} else {
				return true;
			}
		}
	}
	
?>