<?php

	final class QImages_Renderer_Factory {
		private $source = null;
		private $target = null;
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/12/01
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Accept a source file, to work on
		 *
		 * @param	$source 		string
		 *
		 * @access			public
		 * @introduced		2021/12/05
		 *
		 * @return			object typeof QImages_Renderer_Factory
		 */
		 
		public function source( string $source ) : QImages_Renderer_Factory {
			$this -> source = $source;
			
			return $this;
		}
		
		/**
		 * Convert $source file to a $target
		 *
		 * @param	$target			string
		 * @param	$from			string
		 *
		 * @access			public
		 * @introduced		2021/12/05
		 *
		 * @return			object typeof QImages_Renderer_Interface
		 * @throws 			QImages_Renderer_Exception
		 */
		 
		public function convert( string $target, string $from ) : QImages_Renderer_Interface { 
			$this -> target = $target;
			$to = QFile::extension( $target );
			
			$image = $this -> from( $from ); 
			
			if( !QImages::isSupported( $to ) ) {
				throw new QImages_Renderer_Exception( 'thrown exception: unsupported image type [core/images/renderer/factory] 54' );
			}
			
			switch( $to ) {
				case 'jpg':
				case 'jpeg': 
				
					imagejpeg( $image -> getResource(), $target );
					
					return new QImages_Renderer_Jpeg( new QFile( $target ) );
					break;
					
				case 'png':
				
					imagepng( $image -> getResource(), $target );
					
					return new QImages_Renderer_Png( new QFile( $target ) );
					break;
			}
		}
		
		/**
		 * Create an image resource, based on $from
		 *
		 * @param	$from			string
		 *
		 * @access			public
		 * @introduced		2021/12/05
		 *
		 * @return			object typeof QImages_Renderer
		 * @throws			QImages_Renderer_Exception
		 */
		 
		public function from( string $from ) : QImages_Renderer {
			if( !QImages::isSupported( $from ) ) {
				throw new QImages_Renderer_Exception( 'thrown exception: unsupported image type [core/images/renderer/factory]' );
			}
			
			switch( $from ) {
				case 'jpg':
				case 'jpeg':
					
					return new QImages_Renderer_Jpeg( new QFile( $this -> source ) );
					break;
					
				case 'png':
					
					return new QImages_Renderer_Png( new QFile( $this -> source ) );
					break;
			}
		}
		
	}
	
?>