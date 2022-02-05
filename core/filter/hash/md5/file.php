<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Hash_Md5 implements QFilter_Interface {
		private $field_name;
		
		/**
		 * Class constructor
		 * 
		 * @param	$field_name			string
		 * 
		 * @access			public
		 * @introduced
		 * 
		 * @return			void
		 */

		public function __construct( string $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Perform an operation on a peice of data
		 * 
		 * @access			public
		 * @introduced	
		 * 
		 * @return			void
		 */
		
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$dataspace -> set( $this -> field_name, QHash::md5( $dataspace -> get( $this -> field_name ) ) );
		}
	}
	
?>