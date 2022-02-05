<?php

	final class QFront_Controller_Plugins_Filters_Match_Uri implements QFilter_Interface {
		private $reg_expression;
		private $pathname;
		private $header;
		
		/**
		 * Perform an action on a file matched against a regular expression
		 *
		 * @param	$reg_expression		string
		 * @param	$pathname			string		pathname to file
		 * @param	$header				string		typical http header
		 * 
		 * @access						public
		 * @return						void
		 */
		 
		public function __construct( $reg_expression, $pathname, $header ) { 
			$this -> reg_expression = $reg_expression;
			$this -> pathname = $pathname;
			$this -> header = $header;
		}
		
		/**
		 * Watch for a particular uri path and do some processing if found
		 *
		 * @access								public
		 * @return								void
		 */
		 
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( preg_match( $this -> reg_expression, $dataspace -> requestUri() ) ) {
				// found a match regards to a specific uri path
				if( $data = @file_get_contents( $this -> pathname ) ) {
					header( $this -> header );
					
					// output contents of file
					die( $data );
				}
			}
		}
	}
	
?>