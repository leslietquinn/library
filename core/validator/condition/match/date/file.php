<?php

	final class QValidator_Condition_Match_Date extends QValidator_Condition {
		protected $day_name;
		protected $month_name;
		protected $year_name;
		protected $seperator;
		protected $message;
		
		/**
		 * Class constructor
		 * 
		 * @param	$day_name		string	DD
		 * @param	$month_name		string 	MM
		 * @param	$year_name		string	YYYY
		 * @param	$seperator		string		
		 * @param	$message		string
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function __construct( $day_name, $month_name, $year_name, $seperator = '/', $message = '.' ) { 
			$this -> day_name = $day_name;
			$this -> month_name = $month_name;
			$this -> year_name = $year_name;
			
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
			if( !( checkdate( $dataspace -> get( $this -> month_name ), $dataspace -> get( $this -> day_name ), $dataspace -> get( $this -> year_name ) ) ) ) {
				$logger -> set( $this -> day_name, $this -> message );
				$logger -> set( $this -> month_name, $this -> message );
				$logger -> set( $this -> year_name, $this -> message );
				
				return false;
			} 
			return true;
		}
	}
	
?>