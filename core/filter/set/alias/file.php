<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Set_Alias implements QFilter_Interface {
		private $field_name;
		private $alias;
		
		/**
		 * Make a copy of a given parameter under a different name
		 *
		 * @param	$field_name		string
		 * @param	$alias			string
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function __construct( $field_name, $alias ) {
			$this -> field_name = $field_name;
			$this -> alias = $alias;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$dataspace -> set( $this -> alias, $dataspace -> get( $this -> field_name ) );
		}
	}
	
?>