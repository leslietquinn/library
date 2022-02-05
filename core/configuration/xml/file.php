<?php

	final class QConfiguration_Xml implements QSerialisable_Interface {
		private $cfg = null;
		
		public function __construct( QConfiguration $cfg ) {
			$this -> cfg = $cfg;
		}
		
		/**
		 * Put a CSV dataset to filesystem
		 *
		 * @param	$csv			array
		 * @param	$filename		string
		 *
		 * @access			public
		 * @introduced		2021/11/06
		 *
		 * @return			object typeof QConfiguration_Xml
		 */
		 
		public function put( string $filename ) : QConfiguration_Xml {
			
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