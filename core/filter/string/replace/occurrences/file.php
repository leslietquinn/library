<?php

	/**
	 * @package		filter
	 * @version		beta-07e, 13;14-dev
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_String_Replace_Occurrences implements QFilter_Interface {
		private $field_name;
		private $character;
		
		public function __construct( $field_name, $character ) {
			$this -> field_name = $field_name;
			$this -> character = $character;
		}
		
		/**
		 * Remove two or more occurrences of specified character from string
		 *
		 * @note	this was an issue concerning creating a url slug; a space and a dash 
		 *			together, replaced would create two dashes, so now we remove duplicates 
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$dataspace -> set( $this -> field_name, preg_replace( "/".$this -> character."{2,}/", $this -> character, $dataspace -> get( $this -> field_name ) ) );
			
			
		}
	}
	
?>