<?php

	final class QValidator_Condition_Size_Maximum_Array extends QValidator_Condition {
		protected $field_name;
		protected $message;
		protected $size;
		
		public function __construct( $field_name, $size, $message = '.' ) { 
			$this -> field_name = $field_name;
			$this -> message = $message;
			$this -> size = $size;
		}
		
		/**
		 * A specified array length must not exceed maximum
		 *
		 * @param	$dataspace		object
		 * @param	$logger			object
		 *
		 * @access			public
		 * @return			boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) { 
			if( is_array( $dataspace -> get( $this -> field_name ) ) ) {
				if( !( count( $dataspace -> get( $this -> field_name ) ) > $this -> size ) ) {
					return true;
				}
			}
			
			$logger -> set( $this -> field_name, $this -> message );
			return false;
		}
		
	}

?>