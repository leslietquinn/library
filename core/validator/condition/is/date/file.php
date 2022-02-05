<?php

	final class QValidator_Condition_Is_Date extends QValidator_Condition {
		protected $field_name;
		protected $seperator;
		protected $message;
		
		/**
		 * Class constructor
		 * 
		 * @param	$field_name		string		dd/mm/yyyy
		 * @param	$seperator		string		
		 * @param	$message		string
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function __construct( $field_name, $seperator = '/', $message = '.' ) { 
			$this -> field_name = $field_name;
			$this -> seperator = $seperator;
			$this -> message = $message;
		}
		
		/**
		 * A specified date is validated to be true
		 *
		 * @param	$dataspace		object
		 * @param	$logger			object
		 *
		 * @access			public
		 * @return			boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			$range = explode( $this -> seperator, (string) $dataspace -> get( $this -> field_name ) );
			
			$day = $range[0];
			$mon = $range[1];
			$yrs = $range[2];
			
			if( !( checkdate( $mon, $day, $yrs ) ) ) {
				$logger -> set( $this -> field_name, $this -> message );
				return false;
			} 
			return true;
		}
	}
	
?>