<?php

	final class QImages_Renderer_Jpeg extends QImages_Renderer {
		
		/**
		 * Class constructor
		 *
		 * @param	$file		object typeof QFile
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function __construct( QFile $file ) {
			$this -> image = ImageCreateFromJPEG( $file -> getFile() );
		}
		
		/**
		 * Save a JPEG image resource, to file
		 *
		 * @param	$file			object typeof QFile
		 * @param	$source			image resource
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function save( QFile $file, $source ) {
			imageJPEG( $this -> image, $file -> getFile(), $source -> getQuality() );
		}
		
		/**
		 * Output, buffer as response, a JPEG image
		 *
		 * @param	$source			object
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function output( $source ) {
			header( 'Content-Type: image/jpeg' );
			
			imageJPEG( $this -> image, null, $source -> getQuality() );
		}
		
	}
	
?>