<?php

	final class QLogger_Formats_Plain_Text implements QLogger_Formats_Interface {
		public function __construct() {} // not implemented
		
		/**
		 * Format a message to a given format, derived from a string
		 *
		 * @param	$message		mixed
		 *
		 * @access			public
		 * @return			string
		 */
		 
		public function format( $message ) : string {
			$interval = new QInterval();
			return "[".$interval -> today()."] ".$message.QCommon::newline();
		}
	}
	
?>