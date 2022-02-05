<?php

	/**
	 * @package		validator
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QValidator_Condition_Is_Array extends QValidator_Condition { 
		protected $field_name;
		protected $message;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string			field name
		 * @param	$message			string
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function __construct( $field_name, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> message = $message;
		}
		
		/**
		 * Return true if matched fields are equal
		 *
		 * @param	$dataspace			object
		 * @param	$logger				object
		 *
		 * @access				public
		 * @return				boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			$empty = true;
					
			if( $dataspace -> has( $this -> field_name ) ) { 
				if( is_array( $dataspace -> get( $this -> field_name ) ) ) {
					foreach( $dataspace -> get( $this -> field_name ) as $item ) {
						if( !empty( $item ) && isset( $item ) ) {
							$empty = false;
							
							break;
						}
					}
				}
			}
			
			if( !$empty ) { 
				return true;
			}
			
			$logger -> set( $this -> field_name, $this -> message );
			return false;
		}
	}
	
?>