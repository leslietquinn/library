<?php

	final class QEnvironment {
		static public $os_array = array(
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/win16/i'              =>  'Windows 3.11',
			'/windows nt/i'     	=>  'Windows',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/linux/i'              =>  'Linux',
			'/ubuntu/i'             =>  'Ubuntu',
			'/iphone/i'             =>  'iPhone',
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/android/i'            =>  'Android',
			'/blackberry/i'         =>  'BlackBerry',
			'/webos/i'              =>  'Mobile'
		);
		
		public function __construct() {}
		
		/**
		 * Determine the OS based on the user agent string
		 *
		 * @return				string
		 */
		 
		final static public function getOSFromUserAgent( $user_agent ) { 
			$user_agent = strtolower( $user_agent );
			
			foreach( QEnvironment::$os_array as $k => $v ) { 
				if( preg_match( $k, $user_agent ) ) {
					return $v;
				}
			}   
			
			return 'Unknown';
		}
		
		/**
		 * Determine if using Windows OS
		 *
		 * @return				boolean		true|false on condition
		 */
		 
		final static public function winOS() {
			if( strtoupper( PHP_OS_FAMILY ) == 'WINDOWS' ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Determine if using Linux
		 *
		 * @return				boolean		true|false on condition
		 */
		 
		final static public function linuxOS() {
			if( strtoupper( PHP_OS_FAMILY ) == 'LINUX' ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Determine if using Mac OS
		 *
		 * @return				boolean		true|false on condition
		 */
		 
		final static public function macOS() {
			if( strtoupper( PHP_OS_FAMILY ) == 'OSX' ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Determine if using BSD or Solaris OS
		 *
		 * @return				boolean		true|false on condition
		 */
		 
		final static public function BSD() {
			if( ( strtoupper( PHP_OS_FAMILY ) == 'BSD' || strtoupper( PHP_OS_FAMILY ) == 'SOLARIS' ) ) {
				return true;
			}
			
			return false;
		}
		
		
	}
	
?>