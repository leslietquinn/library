<?php

	final class QImages_Renderer_Png extends QImages_Renderer {
		
		/**
		 * Class constructor
		 *
		 * @param	$file		object typeof QFile
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function __construct( QFile $file ) {
			$this -> image = ImageCreateFromPNG( $file -> getFile() );
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
			imagePNG( $this -> image, $file -> getFile(), $source -> getQuality() );
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
			header( 'Content-Type: image/png' );
			
			imagePNG( $this -> image, null, $source -> getQuality() );
		}
		
	}
	
?>