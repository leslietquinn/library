<?php

	/**
	 * @package		file
	 * @version		beta-05f, 06;09-dev
	 * @author		les quinn 
	 */
	 
	class QFile_Buffer {
		private $buffer = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$buffer		string
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function __construct( $buffer = null ) {
			$this -> buffer = $buffer;
		}
		
		/**
		 * Export buffer contents
		 *
		 * @access				public
		 * @return				mixed
		 */
		 
		public function getBuffer() {
			return $this -> buffer;
		}
		
		/**
		 * Output contents of buffer with headers
		 *
		 * @param	$headers 	array	an array of headers
		 * @param	$pathname	mixed	string | null
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function output( $headers, $pathname = null ) {
			if( is_string( $pathname ) ) {
				$this -> load( $pathname );
			}
			
			foreach( (array) $headers as $header ) {
				header( $header );
			}
			
			echo $this -> buffer;
		}
		
		/**
		 * Buffer contents of specified file
		 *
		 * @param	$pathname	string		file pathname
		 *
		 * @access				public
		 * @return				boolean		true|false
		 */
		 
		public function load( $pathname ) { 
			$file = new QFile( $pathname );
			
			if( $file -> isFile() ) {
				$this -> buffer = file_get_contents( $pathname, FILE_USE_INCLUDE_PATH );
				
				return true;
			}
			
			return false;
		}
		
		/**
		 * Save contents to specified file
		 *
		 * @param	$pathname	string		file pathname
		 * @param	$append		boolean		append buffer to an existing file or not
		 *
		 * @access				public
		 * @return				boolean		true|false
		 */
		 
		public function save( $pathname, $append = false ) {
			$file = new QFile( $pathname );
			
			if( !is_null( $this -> buffer ) ) {
				if( $append ) {
					// append buffer to existing file
					file_put_contents( $pathname, $this -> buffer, FILE_APPEND );
				} else {
					file_put_contents( $pathname, $this -> buffer, FILE_USE_INCLUDE_PATH );
				}
				
				return true;
			}
			
			return false;
		}
		
		/**
		 * Create buffer from array
		 *
		 * @param	$dataspace		object
		 * @param	$separator		string		
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function import( QDataspace_Interface $dataspace, $separator = "\r\n" ) {
			$this -> buffer = implode( $separator, $dataspace -> export() );
		}
		
		/**
		 * Replace tokenised string with another string
		 *
		 * @param	$token			string
		 * @param	$replace_with	mixed
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function replace( $token, $replace_with ) {
			$this -> buffer = str_replace( '<phptag:'.$token.' />', (string) $replace_with, $this -> getBuffer() );
		}
		
	}
	
?>