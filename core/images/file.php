<?php

	final class QImages {
		
		private $quality = null;
		
		public function __construct( $quality = 90 ) {
			$this -> quality = $quality;
		}
		
		public function getQuality() : int {
			return $this -> quality;
		}
		
		public function save( QImages_Renderer_Interface $renderer, QFile $file ) {
			$renderer -> save( $file, $this );
		}
		
		public function output( QImages_Renderer_Interface $renderer ) {
			$renderer -> output( $this );
		}
		
		public function merge( QImages_Renderer_Interface $renderer, QImages_Renderer_Interface $target, $x, $y ) {
			$renderer -> merge( $target, $this, $x, $y );
		}
		
		public function setLandscape( QImages_Renderer_Interface $renderer, $width ) {
			$height = ( $width / $renderer -> getWidth() ) * $renderer -> getHeight();
			
			$renderer -> resize( $width, $height );
		}
		
		public function setPortrait( QImages_Renderer_Interface $renderer, $height ) {
			$width = ( $height / $renderer -> getHeight() ) * $renderer -> getWidth();
			
			$renderer -> resize( $width, $height );
		}
		
		public function square(  QImages_Renderer_Interface $renderer, $size ) {
			return $renderer -> resize( $size, $size );
		}
		
		/**
		 * Determine if a file type is supported or not
		 *
		 * @param	$type			string
		 *
		 * @access			public
		 * @introduced		2021/12/05
		 * @static
		 *
		 * @return			bool
		 */
		 
		static public function isSupported( string $type ) : bool {
			if( in_array( $type, array( 'jpeg', 'jpg', 'png' ) ) ) {
				return true;
			}
			
			return false;
		}
		
	}
	
	/**
	 * Example of use
	 *
	 * $pathname = QRegistry::get( '__public' ).'assets/images/sample.jpg';
	 *	
	 * $image = new QImages( 95 );
	 * $renderer = new QImages_Renderer_Jpeg( new QFile( $pathname ) );
	 *	
	 * $image -> square( $renderer, 128 );
	 *	
	 * $image -> output( $renderer );
	 *	
	 * $pathname = QRegistry::get( '__public' ).'assets/images/other-sample.jpg';
	 *	
	 * $image -> save( $renderer, new QFile( $pathname ) );
	 *	
	 */
	
?>