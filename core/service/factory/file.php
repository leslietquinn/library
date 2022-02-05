<?php
	
	abstract class QService_Factory implements QService_Factory_Interface {
		protected $locator = null;
		
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
		 * Return service name, must be in lowercase
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			string
		 */
		 
		abstract public function getServiceName();
		
		/** 
		 * Use a service locator, register dependencies from here
		 *
		 * @param	$locator		object typeof QService_Locator_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			void
		 */
		
		public function storeLocator( QService_Locator_Interface $locator ) {
			$this -> locator = $locator;
		}
		
		/**
		 * Return a factory dependency, by service name
		 *
		 * @param	$dependency			string
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			object typeof QService_Factory_Interface
		 * @throws			QService_Factory_Exception
		 */
		 
		public function getDependency( string $dependency ) : QService_Factory_Interface {
			if( QNull::is( $this -> locator ) ) {
				throw new QService_Factory_Exception( 'thrown exception: misuse of service locator [core/service/factory]' );
			}
			
			$dependency = strtolower( $dependency ); 
			if( $this -> locator -> has( $dependency ) ) {
				return $this -> locator -> get( $dependency );
			}
			
			$class = new $dependency; 
			if( $class instanceof QService_Factory_Interface ) {
				$this -> locator -> register( $class );
				
				return $this -> locator -> get( $dependency );
			}
		}
		
	}	
	
?>