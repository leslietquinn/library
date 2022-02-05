<?php

	final class QImages_Renderer_Text {
		public function __construct() {}
		
		/**
		 * Calculate the length (width) of a string based on font size and typeface in use
		 *
		 * @param	$font_size			integer
		 * @param	$typeface			string	file pathname
		 * @param	$string				string
		 * @param	$canvas_size		integer	width of canvas image
		 *
		 * @return		integer
		 */
		 
		static public function length( int $font_size, string $typeface, string $string, int $canvas_size ) : int {
			$array = imagettfbbox( $font_size, 0, $typeface, $string );
			
			$min = min( array( $array[0], $array[2], $array[4], $array[6] ) );
			$max = max( array( $array[0], $array[2], $array[4], $array[6] ) );
			
			return ( $canvas_size - ( $max - $min ) ) / 2;
		}
		
	}
	
?>