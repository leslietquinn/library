<?php

	/**
	 * @package	random
	 * @version		beta-03e, 06;09-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QRandom {
		public function __construct() {}
		
		final static public function numeric( int $length = 16 ) : string {
			return QRandom::random( $length, '0123456789' );
		}
		
		/**
		 * Generate a random string of certain length
		 *
		 * @param	$length		integer
		 * @param	$chars		string			range of characters to use
		 *
		 * @see		./core/filter/random/file.php
		 *
		 * @access			public
		 * @static
		 * @return			string
		 */
		 
		final static public function random( int $length, string $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' ) : string {
			$size = strlen( $chars );
			
			$string = '';
			for( $i = 0; $i < $length; $i++ ) {
				$string .= $chars[rand( 0, $size - 1 )];
			}
			
			return $string;
		}
		
		/**
		 * Alias for QCommon::unique() class
		 *
		 * @param	$length			integer		length of string
		 *
		 * @static
		 * @access					public
		 * @return					string
		 */
		 
		final static public function unique( int $length = 16 ) : string {
			return QRandom::random( $length, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' );
		}
	}
	
?>