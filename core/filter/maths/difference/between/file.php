<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Maths_Difference_Between implements QFilter_Interface {
		private $difference_name;
		private $alternate_name;
		private $field_name;
		
		public function __construct( $field_name, $alternate_name, $difference_name ) {
			$this -> difference_name = $difference_name;
			$this -> alternate_name = $alternate_name;
			$this -> field_name = $field_name;
		}
		
		/**
		 * Calculate the value difference between two float numbers
		 * 
		 * @see		QMaths::differenceBetween( $source, $target );
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( $dataspace -> has( $this -> field_name ) ) {
				$dataspace -> set( $this -> difference_name, QMaths::differenceBetween( $dataspace -> get( $this -> field_name ), $dataspace -> get( $this -> alternate_name ) ) );
			}
		}
	}
	
?>