<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_String_Crop_Middle implements QFilter_Interface {
		private $field_name;
		private $ending;
		private $length;
		
		public function __construct( $field_name, $length, $ending = '...' ) {
			$this -> field_name = $field_name;
			$this -> ending = $ending;
			$this -> length = $length;
		}
		
		/**
		 * Truncate any string to defined length with separator in middle
		 *
		 * @access				public
		 *
		 * @see					http://css-tricks.com/snippets/php/truncate-string-in-center/
		 *
		 * @return				void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$dataspace -> set( $this -> field_name, $this -> truncate( $dataspace -> get( $this -> field_name ), $this -> length, $this -> ending ) );
		}
		
		/**
		 * Perform truncation
		 *
		 * @param	$string			string
		 * @param	$length			integer		maximum length
		 * @param	$ending			string
		 *
		 * @access				public
		 * @return				string
		 */
		 
		private function truncate( $string, $length, $ending ) {
			$separator_size = strlen( $ending );
			
			$maximum = $length - $separator_size;

			$start = $maximum / 2;
			$trunacted = strlen( $string ) - $maximum;
				
			return substr_replace( $string, $ending, $start, $trunacted );
		}
	}

?>