<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Maths_Multiply implements QFilter_Interface {
		private string $difference_name;
		private string $alternate_name;
		private string $field_name;
		
		/**
		 * Class constructor
		 * 
		 * @param	$field_name			string
		 * @param	$alternate_name		string
		 * @param	$difference_name	string
		 * 
		 * @access			public
		 * @introduced		2022/01/29
		 * @return			void
		 */
		
		public function __construct( string $field_name, string $alternate_name, string $difference_name ) {
			$this -> difference_name = $difference_name;
			$this -> alternate_name = $alternate_name;
			$this -> field_name = $field_name;
		}
		
		/**
		 * Multiple two numbers
		 * 
		 * @see		QMaths::multiply( $source, $target );
		 * 
		 * @access			public
		 * @intoroduced		2022/01/29
		 * @return			void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( $dataspace -> has( $this -> field_name ) ) {
				$dataspace -> set( $this -> difference_name, QMaths::multiply( $dataspace -> get( $this -> field_name ), $dataspace -> get( $this -> alternate_name ) ) );
			}
		}
	}
	
?>