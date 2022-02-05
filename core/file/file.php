<?php
	
	/**
	 * @package		file
	 * @version		beta-05f, 06;09-dev
	 * @author		les quinn 
	 */
	 
	class QFile {
		const READ = 'r';
		const WRITE = 'w';
		const APPEND = 'a';
		
		const UNWANTED_CHARS = '#[\'\,\@\^\?\(\)\[\]\*\+\#\"\\\/\.\&\=\|\:\%\!]+#'; 

		/**
		 * @note file permission owner | group | other
		 *
		 * 0 	no permission
		 * 1 	execute
		 * 2 	write
		 * 3 	write and execute
		 * 4 	read
		 * 5 	read and execute
		 * 6 	read and write
		 * 7 	read, write, and execute
		 */
		 
		private $file;
		
		/**
		 * Perform operations on a file resource
		 * 
		 * @param	$file		resource		a valid file path
		 *
		 * @return				void
		 */
		 
		public function __construct( $file ) {
			$this -> file = $file;
		}
		
		public function read() {
			if( $this -> isFile() ) {
				readfile( $this -> getFile() );
			}
		}
		
		public function setMimetype( $mimetype ) {
			header( $mimetype );
		}
		
		public function setEncoding( $encoding ) {
			header( $encoding );
		}
		
		public function setDisposition( $disposition ) {
			header( $disposition.$this -> getFile() );
		}
		
		/**
		 * Rename $source to what $target is
		 *
		 * @note	13/12/2018 directory file path must end with a trailing slash on Windows OS
		 * 			otherwise expect a denial error or permissions violation
		 */
		 
		public function rename( QFile $target ) {
			if( $this -> isFile() || $this -> isDirectory() ) {
				if( rename( $this -> file, $target -> getFile() ) ) {
					return true;
				} else {
					
					/**
					 * @note	Added following to resolve *nix on Windows, regards file permissions 
					 * @date	19/09/2017
					 *
					 * @see		https://stackoverflow.com/questions/30077379/php-rename-access-is-denied-code-5
					 */
					 
					if( $this -> copy( $target ) ) {
						$this -> remove();
						
						return true;
					}
				}
			} 

			return false;
		}

		/**
		 * Copy file from source to target
		 *
		 * @param	$target		object		typeof QFile represents target
		 *
		 * @return				boolean		true|false on copy success
		 */
		 
		public function copy( QFile $target ) { 
			if( $this -> isFile() ) { 
				if( copy( $this -> file, $target -> getFile() ) ) {
					return true;
				} 
			}
			
			return false;
		}
		
		/**
		 * Move file from source to target
		 *
		 * @param	$target		object		typeof QFile represents target
		 * @param	$is_upload	boolean		true|false if file was an uploaded file
		 *
		 * @access				public
		 * @return				boolean		true|false on move success
		 */
		 	
		public function move( QFile $target, $is_upload = false ) { 
			if( $is_upload ) {
			    if( is_uploaded_file( $this -> file ) ) { 
				    if( move_uploaded_file( $this -> file, $target -> getFile() ) ) {
						return true;
					} 
				} 
			} else {
				if( $this -> isFile() ) {
					if( $this -> copy( $target ) ) {
						if( $this -> remove() ) {
							return true;
						}
					}
				} 
			}
			
			return false;
		}
		
		/**
		 * Determine if file age is older than a defined period
		 *
		 * @param	$period			integer		period of time, in seconds
		 *
		 * @access				public
		 * @return 				bool		true|false on success of file deletion
		 */
		 
		public function hasAged( $period ) : bool {
			$filetime = fileatime( $this -> file ); 
			
			$filetime = $filetime + $period; 
			
			if( time() > $filetime ) {
				// older than stated period
				return true;
			}
			
			return false;
		}
		
		/**
		 * Remove a file
		 *
		 * @access				public
		 * @return 				bool		true|false on success of file deletion
		 */
		 
		public function remove() : bool {
			if( $this -> isFile() ) {
				if( unlink( $this -> file ) ) {
					return true;
				}
			}
			
			return false;
		}
		
		/**
		 * Remove a directory
		 *
		 * @access				public
		 * @return 				boolean		true|false on success of directory deletion
		 */
		 
		public function removeDirectory() {
			if( $this -> isDirectory() ) {
				if( rmdir( $this -> file ) ) {
					return true;
				}
			}
			
			return false;
		}
		
		/**
		 * Create a directory
		 *
		 * @param	$permission			0644 default
		 *
		 * @see		https://stackoverflow.com/questions/5246114/php-mkdir-permission-denied-problem
		 *
		 * @access				public
		 * @return 				boolean		true|false on success of directory creation
		 */
		 
		public function createDirectory( $permission = 0644 ) {
			if( !$this -> isDirectory() ) {
				if( mkdir( $this -> file, $permission ) ) {
					return true;
				}
			}
			
			return false;
		}
		
		/**
		 * Return true if a file, is readable and writable
		 *
		 * @param	$is_writable		bool
		 *
		 * @access			public
		 * @return			bool
		 */
		 
		public function isFile( bool $is_writable = false ) : bool {
			$validation = true;
			if( $is_writable ) {
				
				/**
				 * @note	check that this file is also writable and 
				 *			determine the appropriate outcome
				 */
				 
				if( !is_writable( $this -> file ) ) {
					$validation = false;
				}
			}
			
			if( ( is_file( $this -> file ) and is_readable( $this -> file ) ) and $validation ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Return true if a directory, is readable and writable
		 *
		 * @access			public
		 * @return			bool
		 */
		 
		public function isDirectory() : bool {
			return ( is_dir( $this -> file ) && is_readable( $this -> file ) && is_writable( $this -> file ) );
		}
		
		public function getFile() : string {
			return $this -> file;
		}
		
		public function canWrite() : bool {
			if( is_writable( $this -> getFile() ) ) {
				return true;
			} 
			
			return false;
		}
		
		/**
		 * Returns a file extension
		 *
		 * @param	$file		string		filename 
		 *
		 * @access				public
		 * @return				string		
		 *
		 * @static
		 * @see								QCommon::fileExtension()
		 */
		 
		static public function extension( string $file ) {
			return pathinfo( $file, PATHINFO_EXTENSION ); 
		}
		
		/**
		 * Set permissions for a file
		 *
		 * @param	$permission		integer (default to minimum [0644])
		 *
		 * @access				public
		 * @return				boolean		return if successful or not
		 */
		 
		public function permission( int $permission = 0644 ) : bool {
			if( chmod( $this -> file, $permission ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Open and write data to a file
		 *
		 * @param	$dump			data to write
		 * @param	$flag			append or write, default to write
		 * @param	$use_print_r	boolean, use function print_r( ... ) or not 
		 *							use on array structures only; not plain text
		 *
		 * @access				public
		 * @return				bool
		 */
		 
		public function write( $dump, string $flag = 'w', bool $use_print_r = true ) : bool {
			if( $fp = @fopen( $this -> getFile(), $flag ) ) {
				if( $use_print_r ) {
					$dump = print_r( $dump, true );
				}
				
				@fwrite( $fp, $dump );
				@fclose( $fp );
				
				return true;
			}
			
			return false;
		}
		
		/**
		 * 
		 *
		 * @param	$dump			mixed
		 * @param	$append			boolean
		 * @param	$binary			boolean
		 *
		 * @access		public
		 * @return		bool
		 */
		 
		public function dump( $dump, $append = false, $binary = false ) : bool {
			if( $binary ) {
				// encode binary data, now treated as plain text 
				$dump = base64_encode( $dump );
			}
			
			if( $append ) {
				@file_put_contents( $this -> file, $dump, FILE_APPEND );
			} else {
				@file_put_contents( $this -> file, $dump );
			}
			
			if( $this -> isFile() ) {
				return true;
			}
			
			return false;
		}
		
		public function isSerialised( $dump ) {
			return ( @unserialize( $dump ) !== false );
		}

		public function headers() {
			// disable caching
			$now = gmdate( 'D, d M Y H:i:s' );
			header( 'Expires: Tue, 03 Jul 2001 06:00:00 GMT' );
			header( 'Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate' );
			header( 'Last-Modified: '.$now.' GMT' );

			// force download  
			header( 'Content-Type: application/force-download' );
			header( 'Content-Type: application/octet-stream' );
			header( 'Content-Type: application/download' );

			// disposition / encoding on response body
			header( 'Content-Disposition: attachment;filename='.$this -> getFile() );
			header( 'Content-Transfer-Encoding: binary' );
		}
		
	}
					 	
?>