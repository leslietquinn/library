<?php

	abstract class QImages_Renderer implements QImages_Renderer_Interface {		
		protected $image = null;
		
		public function __construct() {}
		
		public function getResource() {
			return $this -> image;
		}
		
		/**
		 * Return image resource as a base64 encoding
		 *
		 * @param	$file			object typeof QFile
		 *
		 * @access			public
		 * @introduced		2021/11/19
		 *
		 * @see		https://www.php.net/manual/en/function.imagejpeg.php#112796
		 *
		 * @return			string
		 */
		 
		public function encodeBase64( QFile $file ) : string {
			$mimetype = QFile::extension( $file -> getFile() );
			
			$data = file_get_contents( $file -> getFile() );
			return 'data:image/'.$mimetype.';base64,'.base64_encode( $data );
		}
		
		/**
		 * Calculate the aspect ratio of an image
		 *
		 * @access			public
		 * @introduced		2021/12/01
		 *
		 * @see		https://stackoverflow.com/questions/8044052/get-aspect-ratio-from-width-and-height-of-image-php-or-js
		 *
		 * @return			string
		 */
		 
		public function ratio() : string {
			$gcd = $this -> gcd( $this -> getWidth(), $this -> getHeight() );
			
			return ( $this -> getWidth() / $gcd ).':'.( $this -> getHeight() / $gcd );
		}
		
		/**
		 * Return the width of an image, as is
		 *
		 * @access			public
		 * @introduced		2021/11/02
		 *
		 * @return		int
		 */
		 
		public function getWidth() : int {
			return imagesx( $this -> image );
		}
		
		/**
		 * Return the height of an image, as is
		 *
		 * @return		integer
		 */
		 
		public function getHeight() : int {
			return imagesy( $this -> image );
		}
		
		/**
		 * Resize an exist image to new $width and $height
		 *
		 * @param	$width		integer
		 * @param	$height		integer
		 *
		 * @return		void
		 */
		 
		public function resize( int $width, int $height ) {
			$target = ImageCreateTrueColor( $width, $height );
			
			imagecopyresized( 
				$target, 
				$this -> image, 
				0, 
				0, 
				0, 
				0, 
				$width, 
				$height,
				$this -> getWidth(),
				$this -> getHeight() 
			);
			
			// overwrite existing resource
			$this -> image = $target;
		}
		
		/**
		 * Merge one image over another image
		 *
		 * @param	$renderer		object
		 * @param	$source			object	QImages typeof
		 * @param	$x		integer
		 * @param	$y		integer
		 *
		 * @return		void
		 */
		 
		public function merge( QImages_Renderer_Interface $renderer, $source, int $x, int $y ) {
			$target = $renderer -> getResource();
			
			imagecopymerge( 
				$target, 
				$this -> image, 
				$x,
				$y, 
				0, 
				0, 
				$this -> getWidth(),
				$this -> getHeight(),
				$source -> getQuality()
			);
			
			// overwrite existing resource
			$this -> image = $target;
		}
		
		private function gcd( $a, $b ) {
			return ( $a % $b ) ? $this -> gcd( $b, $a % $b ) : $b;
		}
	}
	
?>