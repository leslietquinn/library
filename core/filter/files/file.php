<?php

	/**
	 * @deprecated use QFilter_Files_Import
	 */
	 
	final class QFilter_Files implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Massage data from $_FILES into suitable format I use
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$files = new QParameters( array(
				'name'	=>	$_FILES[$this -> field_name]['name'],
				'type'	=>	$_FILES[$this -> field_name]['type'],
				'erro'	=>	$_FILES[$this -> field_name]['error'],
				'size'	=>	$_FILES[$this -> field_name]['size'],
				'temp'	=>	$_FILES[$this -> field_name]['tmp_name'],
			) );
			
			$dataspace -> import( new QParameters( array(
				$this -> field_name => $files ) ) );
		}	
	}
	
?>