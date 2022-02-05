<?php

	/**
	 * @package		common
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QCommon {
		const ADMINISTRATOR = 'leslietquinn@yandex.com';
		const SESSION_NAME = '__sessionname__';
		const SESSION_TTL = '__ttl__';
		
		const SCREEN_WIDTH = '__screenwidth__';
		
		const REQ_OBJECT = '__request';
		const TMP = '__tmp__';
		
		const PK_SMALL = 8;
		const PK_STANDARD = 16;
		const PK_BIG = 32;
		const PK_HUGE = 40;
			
		const COOKIE_DURATION = 90;
			
		const LOCALE_COUNTRY_TOKEN 			= '__locale_country';					// GB
		const LOCALE_FULL_COUNTRY_TOKEN 	= '__locale_countrycode';				// GBR
		const LOCALE_LANGUAGE_TOKEN 		= '__locale_language';					// en
		const LOCALE_CURRENCY_TOKEN 		= '__locale_currency';					// GBP
		const LOCALE_CURRENCY_SYM_TOKEN 	= '__locale_currencysymbol';			// 
		const LOCALE_TOKEN 					= '__locale_languageandcountry';		// en_GB
		const LOCALE_COUNTRY_NAME_TOKEN		= '__locale_countryname';				// United Kingdom
		
		const DEFAULT_FULL_COUNTRY_TOKEN	=	'GBR';
		const DEFAULT_CURRENCY_TOKEN		=	'GBP';
		const DEFAULT_CURRENCY_SYM_TOKEN	=	'£';
		
		const LIMIT_BY = 18;
		const UNWANTED_CHARS = '#[\'\@\^\?\[\]\*\+\"\\\/\.\&\=\:]+#';
		
		/**
		 * @note	long file and directory names can be an issue, so cut the 
		 * 			length back
		 *
		 * @see		https://stackoverflow.com/questions/28407585/why-cant-php-find-long-filenames/28407644#28407644
		 *
		 */
				 
		const MAX_FILENAME_LENGTH = 64;
		
		/* 
		 * @note one time session tracking
		 */
		 
		const SESSION_TOKEN = '__visitoronly__';
		
		const FLASH_MESSAGE = '__alerts__';
		
		const PAYPAL_SANDBOX = 'https://api-3t.sandbox.paypal.com/nvp';
		const PAYPAL_LIVEBOX = '';
		
		/**
		 * Safe length for page titles, for seo indexing optimise for less than 70 characters
		 */
		 
		const PAGE_TITLE = 56;
		
		public function __construct() {}
		
		final static public function outp( $payload, $vardump = false ) {
			echo( '<br><pre>' );
			
			if( $vardump ) {
				var_dump( $payload );
			} else {
				print_r( $payload );
			}
			
			echo( '</pre><br>' );
		}
		
		/**
		 * Return a file path using consistent \ or / for OS in use, because
		 * Windows OS uses \\ and *nix uses /
		 *
		 * @param	$pathname		string
		 *
		 * @return					string
		 */
		 
		final static public function slashes( $pathname ) { 
			return str_replace( '/', DIR_SEP, $pathname );
		}
		
		/**
		 * Return a unique randomly created string upto a specified size
		 *
		 * @param	$length			integer		size of string
		 *
		 * @return					string		mixed alphanumerics
		 */
		 
		final static public function unique( $length = 16 ) {
			return substr( base64_encode( md5( rand() ) ), 0, $length );
		}
		
		/**
		 * Move up one or more directory levels
		 *
		 * @param	$directory		string
		 * @param	$level			integer		number of directory levels to traverse
		 *
		 * @return					string		directory path
		 */
		 
		final static public function directoryUp( $directory, $level = 1 ) {
			while( $level ) {
				$directory = dirname( $directory );
				$level--;
			}
			
			return $directory;
		}
		
		final static public function newline() {
			if( QEnvironment::winOS() ) {
				return "\r\n";
			}
			
			if( QEnvironment::linuxOS() ) {
				return "\n";
			}
			
			if( QEnvironment::macOS() ) {
				return "\r";
			}
	
			return "\n";
		}
		
		/**
		 * Return the extension of a given filename
		 *
		 * @param	$filename	string
		 *
		 * @return				string		filename extension
		 */
		 
		final static public function fileExtension( $filename ) {
			return ltrim( substr( $filename, strrpos( $filename, '.' ) ), '.' );
		}
		
		final static public function removeTrailingSlash( $url ) {
			if( ( substr( $url, -1 ) == '/' ) || ( substr( $url, -1 ) == '\\' ) ) {
        		return substr( $url, 0, -1 ); 
    		}
			
			return $url;
		}
		
	}

?>