<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Maths_Percentage_Of_Difference implements QFilter_Interface {
		private $alternate_name;
		private $source_name;
		private $target_name;
		
		public function __construct( $source_name, $target_name, $alternate_name ) {
			$this -> alternate_name = $alternate_name;
			$this -> source_name = $source_name;
			$this -> target_name = $target_name;
		}
		
		/**
		 * Calculate the percentage difference between two numbers
		 * 
		 * @see		QMaths::percentageOfDifference( $source, $target );
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( ( $dataspace -> has( $this -> source_name ) && $dataspace -> has( $this -> target_name ) ) ) {
				$dataspace -> set( $this -> alternate_name, QMaths::percentageOfDifference( $dataspace -> get( $this -> source_name ), $dataspace -> get( $this -> target_name ) ) );
			}
		}
	}
	
?>