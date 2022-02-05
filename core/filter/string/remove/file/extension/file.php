<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 *
	 */
	 
	final class QFilter_String_Remove_File_Extension implements QFilter_Interface {
		private $field_name;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2021/12/10
		 *
		 * @return			void
		 */
		 
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Remove the file extension 
		 *
		 * @access			public
		 * @introduced		2021/12/10
		 *
		 * @return			void
		 */
		 
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$rs = preg_replace( '/\\.[^.\\s]{3,4}$/', '', $dataspace -> get( $this -> field_name ) ); 
			
			$dataspace -> set( $this -> field_name, $rs );
		}
	}
	
?>