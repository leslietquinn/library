<?php
	
	/**
	 * @package		logger
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn
	 * @deprecated
	 */
	 
	class QLogger_File implements QLogger_Interface {
		private $log_file;
		
		/**
		 * Class constructor
		 *
		 * @param	$log_file		string		directory path
		 *
		 * @access					public
		 * @return					void
		 */
		 
		public function __construct( $log_file ) {
			$this -> log_file = $log_file;
		}
		
		/**
		 * Log a message to a specific file
		 *
		 * @param	$message		string		message to be logged
		 *
		 * @access					public
		 * @return					void
		 */
		 
		public function log( $message ) { 
			@file_put_contents( $this -> log_file, $message, FILE_APPEND );			
		}
	}
	
?>