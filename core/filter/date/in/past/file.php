<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Date_In_Past implements QFilter_Interface {
		private $use_present;
		private $field_name;
		private $how_far;
		private $format;
		
		/** 
		 * Find and format a date in the past
		 *
		 * @param	$field_name		string
		 * @param 	$how_far		int 	 		how far in the past, in seconds
		 * @param  	$use_present  	bool	  		true | false
		 *											use time() if true, else use $field_name
		 * @param	$format			string			date format
		 *
		 * @return					void
		 */
		 
		public function __construct( string $field_name, int $how_far, bool $use_present, string $format = 'd-m-Y H:i:s' ) {
			$this -> use_present = $use_present;
			$this -> field_name = $field_name;
			$this -> how_far = $how_far;
			$this -> format = $format;
		}
		
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$time = time();
			if( !$this -> use_present ) { 
				$time = QInterval_Date::seconds( $dataspace -> get( $this -> field_name ) );
			}

			$time = $time - $this -> how_far;
			$dataspace -> set( $this -> field_name, date( $this -> format, $time ) );
		}
	}
	
?>