<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Date implements QFilter_Interface {
		private $field_name;
		private $seperator;
		private $format;
		
		/** 
		 * Format a pre existing date
		 *
		 * @param	$field_name		string
		 * @param	$format			string	date format
		 *
		 * @return					void
		 */
		 
		public function __construct( string $field_name, string $format ) {
			$this -> field_name = $field_name;
			$this -> format = $format;
		}
		
		/**
		 * Process data, reformat a given date to another format
		 * 
		 * @access				public
		 * @introduced			2022/01/01 [last modified]
		 * 
		 * @see 				QInterval_Date::reformat();
		 * @return 				void
		 */

		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			$dataspace -> set( $this -> field_name, QInterval_Date::reformat( $this -> format, $dataspace -> get( $this -> field_name ) ) );
		}
	}
	
?>