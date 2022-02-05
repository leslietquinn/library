<?php

	/**
	 * @package		front controller
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 * @ignore
	 */
	 
	final class QFront_Controller implements QFront_Controller_Interface, QFront_Controller_Modules_Manager_Interface {
		private bool $enforce_handler;
		private bool $return_response;
		private bool $no_rendering;

		private $module_manager = null;
		private $plugin_manager = null;
		private $dispatcher = null;
		private $response = null;
		
		/**
		 * Class constructor
		 *
		 * @access 	public
		 * @return	void
		 */
		 
		public function __construct( bool $return_response = false ) {
			$this -> return_response = $return_response;
			$this -> no_rendering = false;
		}
		
		/**
		 * Set the no handler flag to true (default is false)
		 * 
		 * @access			public
		 * @introduced		2022/01/16
		 * @return 			void
		 */

		public function noRendering() : void {
			$this -> no_rendering = true;
		}

		/**
		 * Set dispatcher for Front Controller
		 *
		 * @access	public
		 * @param	$dispatcher			object type QFront_Controller_Dispatcher
		 * @return	void
		 */
		 
		public function setDispatcher( QFront_Controller_Dispatcher_Interface $dispatcher ) : void {
			$this -> dispatcher = $dispatcher;
		}
		
		/**
		 * Run the controller, once programmed
		 *
		 * @access	public
		 * @return			mixed
		 */
		 
		public function run() {
			try {
				$this -> getPluginManager() -> preProcess(); 
				
				try {
					$handler = $this -> getDispatcher() -> dispatch();
				} catch( QFront_Controller_Dispatcher_Exception $e ) { 
					throw new QFront_Controller_Exception( $e -> getMessage() );
				}
				
				$response = $this -> getResponse(); 
				
				if( $handler instanceof QPage_Handler_Interface ) { 
					$response -> output( $handler, QRegistry::get( 'request' ) );
				} else { 
					if( !$this -> no_rendering ) { 

						/**
						 * @note 	2022/01/16
						 * 
						 * 			in some use cases, there is no $handler returned, such as we 
						 * 			use a different templating mechanism (different to QPage_Renderer::* for 
						 * 			instance), output is direct from controller
						 */

						throw new QFront_Controller_Exception( 'thrown exception: unknown output [core/front/controller] 81' );
					}
				}
				
				if( $this -> return_response ) {
					return $response;
				}
				
				$this -> getPluginManager() -> postProcess();
			} catch( QFront_Controller_Exception $e ) {
				throw new QFront_Controller_Exception( $e -> getMessage() );
			}
		}
		
		/** 
		 * Fetch a dispatcher
		 *
		 * @access				public
		 * @introduced			2022/01/20 [last modified]
		 * @return				object 	returns type QFront_Controller_Dispatcher
		 */
		 
		public function getDispatcher() : QFront_Controller_Dispatcher {
			if( is_null( $this -> dispatcher ) ) {
				$this -> dispatcher = new QFront_Controller_Dispatcher();
			}
			return $this -> dispatcher;
		}
		
		/** 
		 * Set up a response
		 *
		 * @param	$response 			object typeof QHttp_Response_Interface
		 * 
		 * @access				public
		 * @introduced			2022/01/20 [last modified]
		 * @return				void
		 */
		 
		public function setResponse( QHttp_Response_Interface $response ) : void {
			$this -> response = $response;
		}
		
		/** 
		 * Get up a response
		 *
		 * @access				public
		 * @introduced			2022/01/20 [last modified]
		 * @return				void
		 */

		public function getResponse() : QHttp_Response_Interface {
			if( is_null( $this -> response ) ) {
				$this -> response = new QHttp_Response();
			}
			return $this -> response;
		}
		
		/**
		 * Add a plugin
		 *
		 * @param	$plugin		object typeof QFront_Controller_Plugins_Interface
		 * 
		 * @access				public
		 * @return				void
		 */
		 
		public function addPlugin( QFront_Controller_Plugins_Interface $plugin ) : void {
			$this -> getPluginManager() -> addPlugin( $plugin );
		}
		
		public function setPluginManager( QFront_Controller_Plugins_Manager_Interface $plugin_manager ) : void {
			$this -> plugin_manager = $plugin_manager;
		}
		
		public function getPluginManager() : QFront_Controller_Plugins_Manager_Interface {
			if( is_null( $this -> plugin_manager ) ) {
				$this -> setPluginManager( new QFront_Controller_Plugins_Manager() );
			}

			return $this -> plugin_manager;
		}
		
		/**
		 * Use a module and all its associated dependencies
		 * 
		 * @param	$module 		string
		 * 
		 * @access			public
		 * @introduced		2022/01/20
		 * @return 			object typeof QFront_Controller_Interface 
		 */

		public function usingModule( string $module ) : QFront_Controller_Interface {
			$this -> getModulesManager() -> usingModule( $module );

			return $this;
		}

		public function setModulesManager( QFront_Controller_Modules_Manager_Interface $module_manager ) : void {
			$this -> module_manager = $module_manager;
		}
		
		public function getModulesManager() : QFront_Controller_Modules_Manager_Interface {
			if( is_null( $this -> module_manager ) ) {
				$this -> setModulesManager( new QFront_Controller_Modules_Manager() );
			}

			return $this -> module_manager;
		}
		
		/**
		 * Define access to application level scripts
		 * 
		 * @param	$directory 			string
		 * 
		 * @access			public
		 * @introduced		2022/01/20 [last modified]
		 * @return 			QFront_Controller_Interface
		 */
		 
		public function setApplicationDirectory( string $directory ) : QFront_Controller_Interface {
			$this -> getDispatcher() -> setApplicationDirectory( $directory );

			return $this;
		}
		
		/**
		 * Define access to standard, generic reusable modules
		 * 
		 * @param	$directory 			string
		 * 
		 * @access			public
		 * @introduced		2022/01/20 [last modified]
		 * @return 			QFront_Controller_Interface
		 */
		 
		public function setModulesDirectory( string $directory ) : QFront_Controller_Interface {
			$this -> getModulesManager() -> setModulesDirectory( $directory );

			return $this;
		}

		/**
		 * Facilitate the preloading of modules
		 * 
		 * @access			public
		 * @introduced		2022/01/20
		 * @return 			bool
		 * @throws			QFront_Controller_Exception
		 */

		public function preload() : bool {
			try {
				if( !$this -> getModulesManager() -> preload() ) {
					throw new QFront_Controller_Modules_Manager_Exception( 'thrown exception: unstable module [core/front/controller] 244' );
				}

				return true;
			} catch( QFront_Controller_Modules_Manager_Exception $e ) { 
				throw new QFront_Controller_Exception( $e -> getMessage() );
			}
		}

	}
	
?>