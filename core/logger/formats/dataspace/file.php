<?php

	final class QLogger_Formats_Dataspace implements QLogger_Formats_Interface {
		public function __construct() {} // not implemented
		
		/**
		 * Format a message to a given format, derived from a string
		 *
		 * @param	$message		object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @return			string
		 */
		 
		public function format( QDataspace_Interface $message ) : string {
			$string = '';
			
			foreach( $message -> export() as $k => $v ) {
				$tmp = str_pad( $k, 32 );
				$string .= $tmp.' : '.$v."\r\n";
			}
			
			return $string;
		}
	}
	
	/**
	 * Example of use
	 *
	 * $logger = new QLogger( new QLogger_File( QRegistry::get( 'directory' ).'logs/null-payments/'.$payment -> get( 'id' ).'.dat' ) );
	 * $logger -> setFormat( new QLogger_Formats_Dataspace() );
	 *
	 * $logger -> log( $dataspace );
	 */
	
?>