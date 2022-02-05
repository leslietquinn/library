<?php

	final class QValidator_Condition_Size_Array extends QValidator_Condition {
		protected $field_name;
		protected $message;
		protected $size;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 * @param	$size				int
		 * @param	$message			string
		 *
		 * @access			public
		 *
		 * @return			void
		 */
		 
		public function __construct( string $field_name, int $size, string $message = '.' ) { 
			$this -> field_name = $field_name;
			$this -> message = $message;
			$this -> size = $size;
		}
		
		/**
		 * A specified array length must be equal
		 *
		 * @param	$dataspace		object
		 * @param	$logger			object
		 *
		 * @access			public
		 * @return			bool
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) : bool { 
			if( is_array( $dataspace -> get( $this -> field_name ) ) ) {
				if( count( $dataspace -> get( $this -> field_name ) ) == $this -> size ) {
					return true;
				}
			}
			
			$logger -> set( $this -> field_name, $this -> message );
			return false;
		}
		
	}
	
?>