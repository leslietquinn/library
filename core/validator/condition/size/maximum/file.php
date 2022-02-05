<?php

	final class QValidator_Condition_Size_Maximum extends QValidator_Condition {
		protected $field_name;
		protected $maximum;
		protected $message;
		
		public function __construct( $field_name, $maximum, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> maximum = $maximum;
			$this -> message = $message;
		}
		
		/**
		 * A specified field length must not exceed a maximum limit
		 *
		 * @param	$dataspace		object
		 * @param	$logger			object
		 *
		 * @access			public
		 * @return			boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			if( strlen( $dataspace -> get( $this -> field_name ) ) > $this -> maximum ) {
				$logger -> set( $this -> field_name, $this -> message );
				return false;
			} 
			return true;
		}
	}
	
?>