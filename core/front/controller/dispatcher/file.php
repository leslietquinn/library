<?php

	/**
	 * @package		front controller
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFront_Controller_Dispatcher implements QFront_Controller_Dispatcher_Interface {
		private string $directory;
		
		public function dispatch() {
			$controller = $this -> requestParameter( 'controller' );
			
			if( !$this -> isDispatchable( $controller ) ) {
				throw new QFront_Controller_Dispatcher_Exception(
					'thrown exception: [dispatcher] unknown controller implementation ('.$controller.') [core/front/controller/dispatcher] 18' 
				);
			} 
			
			$controller = $this -> formatControllerName( $controller );  
			
			if( !class_exists( $controller ) ) { 
				throw new QFront_Controller_Dispatcher_Exception( 
					'thrown exception: [dispatcher] unknown controller implementation ('.$controller.') [core/front/controller/dispatcher] 26' 
				);
			}
			
			$controller = new $controller(); 
			
			try {
				return $controller -> execute( $this );
			} catch( QFront_Controller_Action_Dispatcher_Exception $e ) { 
				throw new QFront_Controller_Dispatcher_Exception( $e -> getMessage() );
			}
		}
		
		public function requestParameter( $parameter ) {
			return QRegistry::get( 'request' ) -> get( $parameter );
		}
		
		public function setApplicationDirectory( $directory ) {
			$this -> directory = $directory;
		}
		
		public function getApplicationDirectory() {
			return $this -> directory;
		}
		
		public function formatActionName( $action ) {
			return strtolower( str_replace( '-', '', $action ) ).'Action';
		}
		
		/**
		 * Format the name of the controller characters a-z and - acceptable
		 *
		 * @param	$controller		string		unformatted controller name
		 *
		 * @access			public
		 * @return			string
		 */
		 
		public function formatControllerName( $controller ) {
			$controller = strtolower( str_replace( '-', ' ', $controller ) );
			$controller = ucwords( $controller ).'_Action_Dispatcher';
			
			return 'Q'.str_replace( ' ', '_', $controller );
		}
		
		/**
		 * Determine if a controller exists or not
		 * 
		 * @param 	$controller 		string
		 * 
		 * @access			private
		 * @introduced		2022/01/22 [last modified]
		 * @return			bool
		 */

		private function isDispatchable( string $controller ) : bool { 
			$includes = $this -> getApplicationDirectory().$controller.'/controller.php';
			
			if( ( file_exists( $includes ) && ( is_file( $includes ) && is_readable( $includes ) ) ) ) {
				include_once( $includes );

				return true;
			} 
			
			return false;
		}
	}
	
?>