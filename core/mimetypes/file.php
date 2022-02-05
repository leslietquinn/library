<?php

	final class QMimetypes {
		static private $mimetypes = array(
			'mp3'     => 'audio/mpeg',
			'm3u'     => 'audio/x-mpegurl',
			'wma'     => 'audio/x-ms-wma',
			'wax'     => 'audio/x-ms-wax',
			'ogg'     => 'application/ogg',
			'wav'     => 'audio/x-wav',
			
			'mpeg'    => 'video/mpeg',
			'mpg'     => 'video/mpeg',
			'mov'     => 'video/quicktime',
			'qt'      => 'video/quicktime',
			'avi'     => 'video/x-msvideo',
			'asf'     => 'video/x-ms-asf',
			'asx'     => 'video/x-ms-asf',
			'wmv'     => 'video/x-ms-wmv',
	
			'gif'     => 'image/gif',
			'jpg'     => 'image/jpeg',
			'jpeg'    => 'image/jpeg',
			'png'     => 'image/png',
			'xbm'     => 'image/x-xbitmap',
			'xpm'     => 'image/x-xpixmap',
			'xwd'     => 'image/x-xwindowdump',
			'bmp'     => 'image/bmp',
			'tif'     => 'image/tiff',
			'tiff'    => 'image/tiff',
			'ico'     => 'image/x-icon',
			'svgz'    => 'image/svg+xml',
			'svg'     => 'image/svg+xml',
			
			'gz'      => 'application/x-gzip',
			'tar.gz'  => 'application/x-tgz',
			'tgz'     => 'application/x-tgz',
			'tar'     => 'application/x-tar',
			'zip'     => 'application/zip',
			'bz2'     => 'application/x-bzip',
			'tbz'     => 'application/x-bzip-compressed-tar',
			'tar.bz2' => 'application/x-bzip-compressed-tar',
		
			'pdf'     => 'application/pdf',
			'sig'     => 'application/pgp-signature',
			'ps'      => 'application/postscript',
			'rtf'     => 'application/rtf',
			
			'csv'		=> 'text/csv',
			'css'     	=> 'text/css',
			'html'    	=> 'text/html',
			'htm'     	=> 'text/html',
			'js'      	=> 'text/javascript',
			'asc'     	=> 'text/plain',
			'c'       	=> 'text/plain',
			'h'       	=> 'text/plain',
			'cc'      	=> 'text/plain',
			'cpp'     	=> 'text/plain',
			'hh'      	=> 'text/plain',
			'hpp'    	=> 'text/plain',
			'conf'    	=> 'text/plain',
			'log'     	=> 'text/plain',
			'text'    	=> 'text/plain',
			'txt'     	=> 'text/plain',
			'diff'    	=> 	'text/plain',
			'patch'   	=> 	'text/plain',
			'php' 		=> 	'text/plain',
			'ini'     	=> 	'text/plain',
			'dat'		=>	'text/plain',
			'dtd'     	=> 	'text/xml',
			'xml'     	=> 	'text/xml',
		
		);
		
		/**
		 * Class constructor
		 * 
		 * @access				public
		 * @introduced			2021/12/31
		 * 
		 * @return				void
		 */

		public function __construct() {}
		
		/**
		 * Determine if a variable exists or not
		 * 
		 * @param	$key 			string
		 * @access				public
		 * @introduced 			2021/12/31
		 * 
		 * @static
		 * @return				bool
		 */

		static public function has( $key ) : bool {
			if( array_key_exists( $key, self::$mimetypes ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * return a value, if it exists
		 * 
		 * @param	$key 			string
		 * @access				public
		 * @introduced 			2021/12/31
		 * 
		 * @static
		 * @return				string
		 */

		static public function get( $key ) : string { 
			if( self::has( $key ) ) {
				return self::$mimetypes[$key];
			}
			
			return '';
		}
	}
	
?>