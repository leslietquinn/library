<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_String_Replace_Tagname implements QFilter_Interface {
		private $field_name;
		private $tagname;
		private $source;
		
		/**
		 * Replace $tagname found in $field_name with $source
		 *
		 * @param	$field_name			string
		 * @param	$tagname			string
		 * @param	$source				mixed
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function __construct( $field_name, $tagname, $source ) {
			$this -> field_name = $field_name;
			$this -> tagname = $tagname;
			$this -> source = $source;
		}
		
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$dataspace -> set( $this -> field_name, str_replace( '<phptag:'.$this -> tagname.' />', $this -> source, $dataspace -> get( $this -> field_name ) ) );
		}
	}
	
?>