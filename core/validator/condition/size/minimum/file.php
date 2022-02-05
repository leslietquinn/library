<?php

	/**
	 * @package		validator
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QValidator_Condition_Size_Minimum extends QValidator_Condition { 
		protected $field_name;
		protected $message;
		protected $minimum;
		
		public function __construct( $field_name, $minimum, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> message = $message;
			$this -> minimum = $minimum;
		}
		
		/**
		 * Return true if length is equal or more than required
		 *
		 * @param	$dataspace			object
		 * @param	$logger				object
		 *
		 * @access				public
		 * @return				boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			if( strlen( $dataspace -> get( $this -> field_name ) ) < $this -> minimum ) {
				$logger -> set( $this -> field_name, $this -> message );
				return false;
			} 
			return true;
		}
	}
	
?>