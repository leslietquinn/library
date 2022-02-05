<?php

	final class QFront_Controller_Modules_Loader implements QFront_Controller_Modules_Loader_Interface {
		private string $module;

		/**
		 * Class constructor
		 * 
		 * @param 	$module 			string
		 * 
		 * @access			public
		 * @introduced		2022/01/20
		 * @return			void
		 */

		public function __construct( string $module ) {
			$this -> module = $module;
		}

		/**
		 * Load a module, and its dependencies
		 * 
		 * @param 	$manager 			object typeof QFront_Controller_Modules_Manager_Interface
		 * 
		 * @access			public
		 * @introduced		2022/01/20
		 * @return			bool
		 */

		public function load( QFront_Controller_Modules_Manager_Interface $manager ) : bool {
			if( !$this -> moduleExists( $manager -> getModulesDirectory() ) ) {
				return false;
			}

			/**
			 * @todo	2022/01/20
			 * 
			 * 			work in a factory method, to remove the hard coded class instantiation and 
			 * 			put the creation elsewhere
			 */
			
			$walker = new QFile_Traverse( $manager -> getModulesDirectory().$this -> module.'/' );
			$walker -> walk( new QFront_Controller_Modules_Loader_File_Traverse_Adapter() );

			return true;
		}

		/**
		 * Determine if a module actually exists, or not
		 * 
		 * @param	$directory 			string
		 * 
		 * @see		QFile::__construct();
		 * 
		 * @access			private
		 * @introduced		2022/01/20
		 * @return			bool
		 */

		private function moduleExists( string $directory ) : bool {
			$file = new QFile( $directory.$this -> module.'/' ); 
			if( $file -> isDirectory() ) {
				return true;
			}

			return false;
		}

	}

?>