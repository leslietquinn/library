<?php

	final class QCsv_Exporter_File implements QAcceptee_Interface {
		private $file = null;
		private $separator;
		private $enclosure;
		private $escape;
		
		/**
		 * Class constructor
		 *
		 * @param	$file			object
		 * @param	$settings		array
		 *
		 * @access			public
		 * @introduced		2021/11/17
		 *
		 * @return			void
		 */
		 
		public function __construct( QFile $file, array $settings ) { 
			$this -> separator = $settings[0];
			$this -> enclosure = $settings[1];
			$this -> escape = $settings[2];
			
			$this -> file = $file;
		}
		
		/**
		 * Perform an operation on $acceptable
		 *
		 * @param	$acceptable			object
		 *
		 * @access			public
		 * @introduced		2021/11/17
		 *
		 * @return			void
		 * @throws			Exception
		 */
		 
		public function push( $acceptable ) {
			if( !$acceptable instanceof QIterator_Interface ) {
				throw new Exception( 'thrown exception: unsupported interface [core/csv/exporter/file]' );
			}
			
			$this -> open();
			$acceptable -> rewind();
			if( is_resource( $this -> fp ) ) { 
				while( !feof( $this -> fp ) && ( $row = fgetcsv( $this -> fp ) ) !== false ) {
					$acceptable -> set( $row );
					$acceptable -> next();
				}
			}
			
			$this -> close();
		}
		
		/**
		 * Open the file resource to receive data
		 *
		 * @access			private
		 * @introduced		2021/11/17
		 *
		 * @return			void
		 */
		 
		private function open() {
			$this -> fp = fopen( $this -> file -> getFile(), QFile::READ );
		}
		
		/**
		 * Close the file, unlocking this resource
		 *
		 * @access			private
		 * @introduced		2021/11/17
		 *
		 * @return			void
		 */
		 
		private function close() {
			fclose( $this -> fp );
		}
	}
	
	/* example of use *//*
	 *
	 *	$path = dirname( __FILE__ ).'/tmp.csv';
	 *
	 *	$payload = new QParameters( array() );
	 *
	 *	$csv = new QCsv( $payload );
	 *	$csv -> accept( new QCsv_Exporter_File( new QFile( $path ), QCsv::settings() ) );
	 *
	 */
	
?>