<?php

	/**
	 * @package		logger
	 * @subpackage	dataspace
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @ignore
	 * @final
	 */
	 
	final class QLogger extends QDataspace implements QLogger_Interface {
		private $logger = null;
		private $format = null;
		
		public function __construct( QLogger_Interface $logger ) {
			$this -> logger = $logger;
		}
		
		/**
		 * Log message using spcified logger
		 *
		 * @param	$message		mixed	represents what is to be logged
		 * @return					boolean	returns true or false based on successful log
		 */
		 
		public function log( $message ) : bool {
			if( $this -> logger -> log( $this -> format( $message ) ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Utility function to determine if any messages have been logged or not
		 *
		 * @access					public
		 * @return					boolean		true|false
		 */
		 
		public function hasLog() : bool {
			if( count( $this -> parameters ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Format a string suitable for logging
		 *
		 * @param	$message		mixed
		 *
		 * @access					protected
		 * @return					string
		 */
		 
		protected function format( string $message ) : string {
			return $this -> getFormat() -> format( $message );
		}
		
		/**
		 * Set up the faciliation for formatting the log message
		 *
		 * @param	$format			object typeof QLogger_Formats_Interface
		 *
		 * @acceess			public
		 *
		 * @return			void
		 */
		 
		public function setFormat( QLogger_Formats_Interface $format ) {
			$this -> format = $format;
		}
		
		/**
		 * Return the facilitor what formats the log message
		 *
		 * @access			public
		 *
		 * @return			object typeof QLogger_Formats_Interface
		 */
		 
		public function getFormat() : QLogger_Formats_Interface {
			if( is_null( $this -> format ) ) {
				$this -> setFormat( new QLogger_Formats_Plain_Text() );
			}
			
			return $this -> format;
		}
		
		/**
		 * Clear out the log
		 *
		 * @access			public
		 *
		 * @return			void
		 */
		 
		public function clearLog() {
			$this -> parameters = array();
		}
	}
	
?>