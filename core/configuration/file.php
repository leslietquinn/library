<?php
	
	final class QConfiguration extends QDataspace implements QSerialisable_Interface {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/11/06
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Facilitate the use of a CSV structure
		 *
		 * @access			public
		 * @introduced		2021/11/06
		 *
		 * @return			object typeof QConfiguration_Csv
		 */
		 
		public function asCsv() {
			return new QConfiguration_Csv( $this );
		}
		
		/**
		 * Facilitate the use of an array structure
		 *
		 * @access			public
		 * @introduced		2021/11/06
		 *
		 * @return			object typeof QConfiguration_Array
		 */
		 
		public function asArray() {
			return new QConfiguration_Array( $this );
		}
		
		/**
		 * Facilitate the use of an XML structure
		 *
		 * @access			public
		 * @introduced		2021/11/06
		 *
		 * @return			object typeof QConfiguration_Xml
		 */
		 
		public function asXml() {
			return new QConfiguration_Xml( $this );
		}
		
		/**
		 * Grab serialisable dataset and return 
		 *
		 * @param	$filename			string
		 *
		 * @access			public
		 * @introduced		2021/11/06
		 *
		 * @return			array
		 */
		 
		public function grab( string $filename ) : array {
			$stack = new QStack();
			return $stack -> grab( $filename );
		}
	}
	
?>