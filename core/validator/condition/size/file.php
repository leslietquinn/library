<?php

	final class QValidator_Condition_Size extends QValidator_Condition {
		protected $field_name;
		protected $size;
		protected $message;
		
		public function __construct( $field_name, $size, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> size = $size;
			$this -> message = $message;
		}
		
		/**
		 * A specified field length must match length exactly
		 *
		 * @param	$dataspace		object
		 * @param	$logger			object
		 *
		 * @access			public
		 * @return			boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			if( !( strlen( $dataspace -> get( $this -> field_name ) ) == $this -> size ) ) {
				$logger -> set( $this -> field_name, $this -> message );
				return false;
			} 
			return true;
		}
	}
	
?>