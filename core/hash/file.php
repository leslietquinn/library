<?php

	final class QHash {
		public function __construct() {}
		
		/**
		 * Return a string after MD5 algorithm
		 * 
		 * @param	$string			string
		 * 
		 * @access			public
		 * @introduced		2022/01/09
		 * @static
		 * 
		 * @return			string
		 */

		static public function md5( string $string ) : string {
			return md5( $string );
		}
		
	}
	
?>