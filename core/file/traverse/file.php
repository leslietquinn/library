<?php

	final class QFile_Traverse implements QTraverse_Interface {
		private $path;
		
		/**
		 * Class constructor
		 *
		 * @param	$path			string file path, no trailing slash
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function __construct( $path ) {
			$this -> path = $path;
		}

		/**
		 * Traverse recursively through a directory structure
		 *
		 * @param	$acceptee			object typeof QAcceptee_Interface
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function walk( QAcceptee_Interface $acceptee ) {
			$handle = opendir( $this -> path ); 
			
			if( is_resource( $handle ) ) {
				while( $entry = readdir( $handle ) ) {
					if( $entry == '.' or $entry == '..' ) {
						continue;
					}
					
					$entry = $this -> path.DIR_SEP.$entry;
					
					// capture both file and directory
					$acceptee -> push( $entry );
					
					if( is_dir( $entry ) ) { 
						$traversal = new QFile_Traverse( $entry );
						$traversal -> walk( $acceptee );
					} 
				}
			}
			
			closedir( $handle );
		}
	}
	
?>