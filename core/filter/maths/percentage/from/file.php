<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Maths_Percentage_From implements QFilter_Interface {
		private $alternate_name;
		private $field_name;
		private $percentage;
		
		public function __construct( $field_name, $alternate_name, $percentage ) {
			$this -> alternate_name = $alternate_name;
			$this -> field_name = $field_name;
			$this -> percentage = $percentage;
		}
		
		/**
		 * Calculate the value minus a percentage taken off
		 * 
		 * @see		QMaths::percentageFrom( $value, $percentage );
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( $dataspace -> has( $this -> field_name ) ) {
				$dataspace -> set( $this -> alternate_name, QMaths::percentageFrom( $dataspace -> get( $this -> field_name ), $dataspace -> get( $this -> percentage ) ) );
			} 
		}
	}
	
?>