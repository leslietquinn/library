<?php

	final class QString {
		
		/**
		 * @note	generic string crop length, say for P tags for example
		 *
		 */
		 
		const CROP_LENGTH = 256;
		
		/**
		 * Determine if string has been base64 encoded or not
		 *
		 * @param	$encoded			string
		 *
		 * @access			public
		 * @introduced		2021/11/19
		 * @static
		 *
		 * @return			bool
		 */
		 
		static public function isValidBase64( string $encoded ) : bool {
			$decoded = base64_decode( $encoded, true );

			if( !preg_match( '/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $encoded ) ) {
				return false;
			}
			
			if( !$decoded ) {
				return false;
			}
			
			if( base64_encode( $decoded ) != $encoded ) {
				return false;
			}
			
			return true;
		}
		
		/**
		 * Return boolean if $parameter is empty, not set or null
		 *
		 * @param	$parameter			mixed
		 *
		 * @access				public
		 * @return				bool
		 */
		 
		static public function empty( $parameter ) : bool {
			if( ( is_null( $parameter ) || empty( $parameter ) || !isset( $parameter ) ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Compare a partial string against a whole 
		 *
		 * @param	$source			string
		 * @param	$string			string
		 *
		 * @access			public
		 * @return			string
		 */
		 
		static public function startsWith( string $source, string $string ) : string {
			return substr( $source, 0, strlen( $string ) ) === $string;
		}
		
		/**
		 * Compare a partial string against a whole 
		 *
		 * @param	$source			string
		 * @param	$string			string
		 *
		 * @access			public
		 * @return			string
		 */
		 
		static public function endsWith( string $source, string $string ) : string {
			$length = strlen( $string );
			
			if( !$length ) {
				return true;
			}
			
			return substr( $source, -$length ) === $string;
		}
	}
	
?>