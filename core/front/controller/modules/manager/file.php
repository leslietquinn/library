<?php
	
	final class QFront_Controller_Modules_Manager implements QFront_Controller_Modules_Manager_Interface {
		private string $directory;
		private array $modules;

		/**
		 * Class constructor
		 * 
		 * @access			public
		 * @introduced		2022/01/20 
		 * @return			void
		 */

		public function __construct() {}

		/**
		 * Set up the directory where the modules are found
		 * 
		 * @param	$directory			string
		 * 
		 * @access			public
		 * @introduced		2022/01/20
		 * @return			void
		 */

		public function setModulesDirectory( string $directory ) : void {
			$this -> directory = $directory;
		}

		/**
		 * Return the directory where modules are stored
		 * 
		 * @access			public
		 * @introduced		2022/01/20
		 * @return 			string
		 */

		public function getModulesDirectory() : string {
			return $this -> directory;
		}

		/**
		 * Using this $module
		 * 
		 * @param	$module 			string
		 * 
		 * @access			public
		 * @introduced		2022/01/20
		 * @return			void
		 */

		public function usingModule( string $module ) : void {
			$this -> modules[] = new QFront_Controller_Modules_Loader( $module );
		}

		/**
		 * Attempt to preload each module and its dependencies
		 * 
		 * @see 		QFront_Controller::preload();
		 * 
		 * @access			public
		 * @introduced		2022/01/20
		 * @return			bool
		 * @throws			QFront_Controller_Modules_Manager_Exception
		 */

		public function preload() : bool {
			if( count( $this -> modules ) == 0 ) {
				throw new QFront_Controller_Modules_Manager_Exception( 'thrown exception: no modules in use [core/front/controller/modules/manager] 70' );
			}

			$validation = true;
			foreach( $this -> modules as $module ) { 
				if( !( $module instanceof QFront_Controller_Modules_Loader_Interface ) ) {
					throw new QFront_Controller_Modules_Manager_Exception( 'thrown exception: illegal module loader interface [core/front/controller/modules/manager] 76' );
				}

				/**
				 * @note 	all or nothing; only valid if $module is valid (true is returned) and also 
				 * 			previous modules were also valid, otherwise invalid
				 */

				$validation = $module -> load( $this ) and $validation;
			}

			return $validation;
		}

		/**
		 * Format the name for this module
		 * 
		 * @param	$name 			string
		 * 
		 * @access 			public
		 * @introduced		2022/01/22
		 * @return 			string
		 */

		public function formatName( string $name ) : string {
			return ucwords( $name );
		}

	}

?>