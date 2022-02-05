<?php
	
	final class QFront_Controller_Modules_Loader_File_Traverse_Adapter implements QAcceptee_Interface {

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
			if( QFile::extension( $acceptable ) == 'php' ) { 
				$file = new QFile( $acceptable );
				if( $file -> isFile() ) { 
					include_once( $acceptable );
				}
			}
		}
	}

?>