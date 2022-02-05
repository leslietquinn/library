<?php

	final class QInternationalisation_String {
		const SEPARATOR = '-';
		
		public function __construct() {}
		
		/**
		 * Return an ISO8859-1 encoded string as an UTF-8 encoded string
		 *
		 * @param	$string			string
		 *
		 * @access			public
		 * @introduced		2021/11/09
		 * @static
		 *
		 * @return			string
		 */
		 
		public function iso88591ToUtf8( string $string ) : string {
			return utf8_encode( $string );
		}
		
		/**
		 * Return an UTF-8 encoded string as an ISO8859-1 encoded string
		 *
		 * @param	$string			string
		 *
		 * @access			public
		 * @introduced		2021/11/09
		 * @static
		 *
		 * @return			string
		 */
		 
		public function utf8ToIso88591( string $string ) : string {
			return utf8_decode( $string );
		}
		
		/**
		 * Create a slug from any string
		 *
		 * @param	$string		string
		 * @param	$separator	string 
		 *
		 * @access				public
		 * @return				boolean
		 */
		 
		static public function taint( $string, $separator = '-' ) {
			if( function_exists( 'mb_strtolower' ) ) {
				$string = mb_strtolower( $string );
			} else {
				$string = strtolower( $string );
			}

			$string = preg_replace( '/(\\w)\'(\\w)/', '${1}${2}', preg_replace( '/\W/', ' ', $string ) );

			$string = strtolower( preg_replace( '/[^A-Za-z0-9\/]+/', $separator, preg_replace( '/([a-z\d])([A-Z])/', '\1_\2', preg_replace( '/([A-Z]+)([A-Z][a-z])/', '\1_\2', preg_replace( '/::/', '/', $string ) ) ) ) );

			return trim( $string, $separator );
		}
		
		/**
		 * Convert unicode or utf8 characters to ascii equivalents
		 *
		 * @param	$string			string
		 * @param	$with_taint		boolean	wether or not to taint string
		 *
		 * @access				public
		 * @return				boolean
		 */
		 
		static public function transliterate( $string, $with_taint = true ) { 
			if( preg_match( '/[\x80-\xff]/', $string ) && self::isUtf8( $string ) ) {
				$string = self::utf8ToAscii( $string );
			}
			
			if( $with_taint ) {
				return self::taint( $string, self::SEPARATOR );
			}
			
			return $string;
		}
		
		static public function utf8ToAscii( $string, $error = '' ) {
			static $UTF8_TO_ASCII;

			if( strlen( $string ) == 0 ) {
				return '';
			}

			preg_match_all( '/.{1}|[^\x00]{1,1}$/us', $string, $ar );
			$chars = $ar[0];

			foreach( $chars as $i => $c ) {
				if( ord( $c[0] ) >= 0 && ord( $c[0] ) <= 127 ) {
					continue;
				} 
				
				if( ord( $c[0] ) >= 192 && ord( $c[0] ) <= 223 ) {
					$ord = ( ord( $c[0] ) - 192) * 64 + ( ord( $c[1] ) - 128 );
				}
				
				if( ord( $c[0] ) >= 224 && ord( $c[0] ) <= 239 ) {
					$ord = ( ord( $c[0] ) - 224 ) * 4096 + ( ord( $c[1] ) - 128 ) * 64 + ( ord( $c[2] ) - 128) ;
				}
				
				if( ord( $c[0] ) >= 240 && ord( $c[0] ) <= 247 ) {
					$ord = ( ord( $c[0] ) - 240 ) * 262144 + ( ord( $c[1] ) - 128 ) * 4096 + ( ord( $c[2] ) - 128 ) * 64 + ( ord( $c[3] ) - 128 );
				}
				
				if( ord( $c[0] ) >= 248 && ord( $c[0] ) <= 251 ) {
					$ord = ( ord( $c[0] ) - 248 ) * 16777216 + ( ord( $c[1] ) - 128 ) * 262144 + ( ord( $c[2] ) - 128 ) * 4096 + ( ord( $c[3] ) - 128 ) * 64 + ( ord( $c[4] ) - 128 );
				}
				
				if( ord( $c[0] ) >= 252 && ord( $c[0] ) <= 253 ) {
					$ord = ( ord( $c[0] ) - 252 ) * 1073741824 + ( ord( $c[1] ) - 128 ) * 16777216 + ( ord( $c[2] ) - 128 ) * 262144 + ( ord( $c[3] ) - 128 ) * 4096 + ( ord( $c[4] ) - 128 ) * 64 + ( ord( $c[5] ) - 128 );
				}
				
				if( ord( $c[0] ) >= 254 && ord( $c[0] ) <= 255 ) {
					$chars[$i] = $unknown;
					continue;
				} 

				$bank = $ord >> 8;

				if( !array_key_exists( $bank, (array) $UTF8_TO_ASCII ) ) {
					$bankfile = __DIR__.'/data/'.sprintf( 'x%02x', $bank ).'.php';
					if( file_exists( $bankfile ) ) {
						include $bankfile;
					} else {
						$UTF8_TO_ASCII[$bank] = array();
					}
				}

				$newchar = $ord & 255;
				if( array_key_exists( $newchar, $UTF8_TO_ASCII[$bank] ) ) {
					$chars[$i] = $UTF8_TO_ASCII[$bank][$newchar];
				} else {
					$chars[$i] = $unknown;
				}
			}

			return implode( '', $chars );
		}
	
		/**
		 * Determine if string is a match against utf8
		 *
		 * @param	$string		string
		 *
		 * @access				public
		 * @return				boolean
		 */
		 
		static public function matchesUtf8( $string ) {
			return preg_match( '/\A(?>[\x00-\x7F]+|[\xC2-\xDF][\x80-\xBF]|\xE0[\xA0-\xBF][\x80-\xBF]|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}|\xED[\x80-\x9F][\x80-\xBF]|\xF0[\x90-\xBF][\x80-\xBF]{2}|[\xF1-\xF3][\x80-\xBF]{3}|\xF4[\x80-\x8F][\x80-\xBF]{2})*\z/x', $string ) === 1;
		}

		static public function isUtf8( $string ) {
			$mUcs4 = 0; 
			$mBytes = 1; 
			$mState = 0; 
			
			$len = strlen( $string );
			for( $i = 0; $i < $len; ++$i ) {
				$in = ord( $string[$i] );
				if( $mState == 0 ) {
					if( 0 == ( 0x80 & ( $in ) ) ) {
						$mBytes = 1;
					} elseif( 0xC0 == ( 0xE0 & ( $in ) ) ) {
						$mUcs4 = ( $in );
						$mUcs4 = ( $mUcs4 & 0x1F ) << 6;
						$mState = 1;
						$mBytes = 2;
					} elseif( 0xE0 == ( 0xF0 & ( $in ) ) ) {
						$mUcs4 = ( $in );
						$mUcs4 = ( $mUcs4 & 0x0F ) << 12;
						$mState = 2;
						$mBytes = 3;
					} elseif( 0xF0 == ( 0xF8 & ( $in ) ) ) {
						$mUcs4 = ( $in );
						$mUcs4 = ( $mUcs4 & 0x07 ) << 18;
						$mState = 3;
						$mBytes = 4;
					} elseif( 0xF8 == ( 0xFC & ( $in ) ) ) {
						$mUcs4 = ( $in );
						$mUcs4 = ( $mUcs4 & 0x03 ) << 24;
						$mState = 4;
						$mBytes = 5;
					} elseif( 0xFC == ( 0xFE & ( $in ) ) ) {
						$mUcs4 = ( $in );
						$mUcs4 = ( $mUcs4 & 1 ) << 30;
						$mState = 5;
						$mBytes = 6;
					} else {
						return false;
					}
				} else {
					if( 0x80 == ( 0xC0 & ( $in ) ) ) {
						$shift = ( $mState - 1 ) * 6;
						$tmp = $in;
						$tmp = ( $tmp & 0x0000003F ) << $shift;
						$mUcs4 |= $tmp;
						
						if( 0 == --$mState ) {
							if( ( ( 2 == $mBytes ) && ( $mUcs4 < 0x0080 ) ) ||( ( 3 == $mBytes ) && ( $mUcs4 < 0x0800 ) ) || ( ( 4 == $mBytes ) && ( $mUcs4 < 0x10000 ) ) || ( 4 < $mBytes ) || ( ( $mUcs4 & 0xFFFFF800 ) == 0xD800 ) || ( $mUcs4 > 0x10FFFF ) ) {
								return false;
							}
							
							$mState = 0;
							$mUcs4 = 0;
							$mBytes = 1;
						}
					} else {
						return false;
					}
				}
			}

			return true;
		}
		
		/**
		 * Determine if string appears to be UTF7 compliant or not
		 *
		 * @param	$string		string
		 *
		 * @access				public
		 * @return				boolean
		 */
		 
		public function isUtf7( $string ) {
			// return ( utf8_encode( $this -> fromUtf8( $this -> string ) ) == $this -> string ); 
			
			$string_length = strlen( $string );
			for( $i = 0; $i < $string_length; ++$i ) {
				if( ord( $string[$i] ) < 0x80 ) { 
					continue;
				} elseif( ( ord( $string[$i] ) & 0xE0 ) == 0xC0 ) { 
					$n = 1;
				} elseif( ( ord( $string[$i] ) & 0xF0 ) == 0xE0 ) { 
					$n = 2;
				} elseif( ( ord( $string[$i] ) & 0xF8 ) == 0xF0 ) { 
					$n = 3;
				} elseif( ( ord( $string[$i] ) & 0xFC ) == 0xF8 ) { 
					$n = 4;
				} elseif( ( ord( $string[$i] ) & 0xFE ) == 0xFC ) { 
					$n = 5;
				} else {
					// illegal or null string
					return false; 
				}

				for( $j = 0; $j < $n; ++$j ) { 
					if( ++$i === $string_length || ( ( ord( $string[$i] ) & 0xC0 ) !== 0x80 ) ) {
						// illegal or null string
						return false;
					}
				}
			}
			
			return true;
		}
		
		/**
		 * Remove non compliant UTF8 characters, keep valid characters only
		 *
		 * @param	$string				string
		 *
		 * @see		https://planetozh.com/blog/2005/01/remove-invalid-characters-in-utf-8/
		 *
		 * @access			public
		 * @static
		 * @introduced		2021/11/06
		 * @return			string
		 */
		 
		static public function validUTF8Only( string $string ) : string {
			return iconv( "UTF-8", "UTF-8//IGNORE", $string );			
		}
		
		/*
		 * @see http://wiki.secondlife.com/wiki/Unicode_In_5_Minutes
		 */
		 
	}
	
?>