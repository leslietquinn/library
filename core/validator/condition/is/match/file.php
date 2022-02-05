<?php

	/**
	 * @package		validator
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QValidator_Condition_Is_Match extends QValidator_Condition { 
		protected $comparison;
		protected $field_name;
		protected $message;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string			field name
		 * @param	$comparison			string			field name
		 * @param	$message			string
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function __construct( $field_name, $comparison, $message = '.' ) {
			$this -> comparison = $comparison;
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
			if( $dataspace -> get( $this -> field_name ) == $dataspace -> get( $this -> comparison ) ) {
				return true;
			}
			
			$logger -> set( $this -> field_name, $this -> message );
			return false;
		}
	}
	
?>