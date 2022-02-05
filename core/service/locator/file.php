<?php

	final class QService_Locator implements QService_Locator_Interface {
		private $factories = array();
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/** 
		 * Register a new factory
		 *
		 * @note	once registered an instantiated factory, access the factory from that point 
		 *			onwards through the $locator -> get(); only, and not use the instantiation 
		 *			directly
		 *
		 *			dependencies can be created by calling ::getDependency(); from within a factory 
		 *			method, before the dependency is needed
		 *
		 * @param	$factory		object
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			object typeof QService_Locator_Interface
		 * @throws			QService_Locator_Exception
		 */
		 
		public function register( QService_Factory_Interface $factory ) : QService_Locator_Interface {
			if( $this -> has( $factory -> getServiceName() ) ) {
				
				/**
				 * @note	do not let a factory to be registered again, which 
				 *			may disrupt existing dependencies already registered, 
				 *			causing a ripple effect throughout space and time 8D
				 *
				 */
				 
				throw new QService_Locator_Exception( 'thrown exception: factory service already registered [core/service/locator]' );
			}
			
			$this -> factories[$factory -> getServiceName()] = $factory;
			$factory -> storeLocator( $this );
				
			return $this;
		}
		
		/**
		 * Does the service locator has a service, or not
		 *
		 * @param	$service			string
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			bool
		 */
		 
		public function has( string $service ) : bool {
			if( array_key_exists( $service, $this -> factories ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Get access to a factory service
		 *
		 * @param	$service		string
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			object typeof QService_Factory_Interface
		 * @throws			QService_Locator_Exception
		 */
		 
		public function get( string $service ) : QService_Factory_Interface {
			$service = strtolower( $service ); 
			
			if( array_key_exists( $service, $this -> factories ) ) {
				return $this -> factories[$service];
			}
			
			throw new QService_Locator_Exception( 'thrown exception: service factory not registered [core/service/locator]' );
		}
	}
	
?>