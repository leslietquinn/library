<?php

	final class QCsv_Importer_File implements QAcceptee_Interface {
		private $file = null;
		private $separator;
		private $enclosure;
		private $fp = null;
		private $escape;
		
		/**
		 * Class constructor
		 *
		 * @param	$file			object typeof QFile
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
		 * Import data into a file, from $acceptable
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
				throw new Exception( 'thrown exception: unsupported interface [core/csv/importer/file]' );
			}
			
			$this -> open();
			$acceptable -> rewind();
			while( $acceptable -> valid() ) {
				$row = $acceptable -> current();
				$acceptable -> next();
				
				if( is_resource( $this -> fp ) ) {
					fputcsv( $this -> fp, $row, $this -> separator, $this -> enclosure, $this -> escape );
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
			$this -> fp = fopen( $this -> file -> getFile(), QFile::WRITE );
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
	 * 	$payload = array(
	 * 		0	=>	array(	'id', 'name', 'price' ),
	 *		1	=>	array( '9494', 'Product One', '49.99' ),
	 *		2	=>	array( '4788', 'Product Two', '29.99' ),
	 *		3	=>	array( '1293', 'Product Three', '99.99' ),
	 *		4	=>	array( '3002', 'Product Four', '149.99' ),
	 * 	);
	 *
	 *	$path = dirname( __FILE__ ).'/tmp.csv';
	 *
	 *	$csv = new QCsv( new QParameters( $payload ) );
	 *	$csv -> accept( new QCsv_Importer_File( new QFile( $path ), QCsv::settings() ) );
	 */
	 
?>