<?php

	final class QFront_Controller_Plugins_Logger implements QFilter_Interface {
		private $filename;
		
		/**
		 * Store a record of incoming request
		 *
		 * @param	$filename			string
		 * 
		 * @access						public
		 * @return						void
		 */
		 
		public function __construct( string $filename ) { 
			$this -> filename = $filename;
		}
		
		/**
		 * Log certain things about a typical request
		 *
		 * @access								public
		 * @return								void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$pathname = QRegistry::get( '__protected' ).'logs/'.$this -> filename;
			$logger = new QLogger( new QLogger_File( $pathname ) );
			
			$log = '- '.$dataspace -> get( '__ipaddress' ).' - '.$dataspace -> get( '__uri' ).' - '.$dataspace -> get( '__useragent' ).' - '.$dataspace -> get( '__referer' );
			$logger -> log( $log );
		}
	}
	
?>