<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Date_Timers_Countdown implements QFilter_Interface {
		private $field_name;
		
		/**
		 * Create a static countdown timer from a given date, for days, hours and minutes
		 *
		 * @param	$field_name		string	
		 * @param	$alternate_name	string
		 *
		 * @return					void
		 */
		 
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			$interval = new QInterval();
			$dataspace -> import( $interval -> countdown( $dataspace -> get( $this -> field_name ) ) );			
		}
	}
	
?>