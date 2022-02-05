<?php
	
	final class QFile_Traverse_Adapter implements QAcceptee_Interface {

		/**
		 * Class constructor
		 * 
		 * @access			public
		 * @introduced		2022/01/20 [last modified]
		 * @return			void
		 */

		public function __construct() {}

		/**
		 * Perform an operation on a some data
		 * 
		 * @param 	$acceptable 			object
		 * 
		 * @access			public
		 * @introduced		2022/01/20
		 * @return 			void
		 */

		public function push( $acceptable ) {
			$file = new QFile( $acceptable );
			if( $file -> isFile() ) { 
				include_once( $acceptable );
			}
		}
	}

?>