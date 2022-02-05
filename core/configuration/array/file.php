<?php

	final class QConfiguration_Array implements QSerialisable_Interface {
		private $cfg = null;
		
		public function __construct( QConfiguration $cfg ) {
			$this -> cfg = $cfg;
		}
		
		/**
		 * Put an array dataset to filesystem
		 *
		 * @param	$array			array
		 * @param	$filename		string
		 *
		 * @access			public
		 * @introduced		2021/11/06
		 *
		 * @return			object typeof QConfiguration_Array
		 */
		 
		public function put( array $array, string $filename ) : QConfiguration_Array {
			$stack = new QStack();
			$stack -> put( $array, $filename );
			
			return $this;
		}
		
		/**
		 * Grab a file and put to array the serialised dataset
		 *
		 * @param	$filename			string
		 *
		 * @access			public
		 * @introduced		2021/11/06
		 *
		 * @return			array
		 */
		 
		public function grab( string $filename ) : array {
			return $this -> cfg -> grab( $filename );
		}
		
	}
	
?>