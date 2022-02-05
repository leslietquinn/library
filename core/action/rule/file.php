<?php

	class QAction_Rule implements QAction_Rule_Interface {
		protected $decorator = null;
		
		public function __construct( $decorator ) {
			$this -> decorator = $decorator;
		}
		
		public function isAllowed( QAction_Interface $action ) {
			// $action::isSecure() returns boolean
			return method_exists( $action, 'issecure' ) && $action -> isSecure();
		}
		
		/**
		 * Apply a rule on a given action using the "decorator" design pattern
		 *
		 * @param	$action			object		typeof QAction_Interface
		 *
		 * @return					object		
		 */
		 
		public function applyRule( QAction_Interface $action ) {
			$decorator = $this -> decorator;
			$decorator = new $decorator( $action );
			return $decorator;
		}
	}
	
	// ie
	// $dispatcher = new QAction_Dispatcher();
	// $dispatcher -> attach( new QAction_Rule( 'AccessControlAction' ) );
	// $dispatcher -> attach( new QAction_Rule( 'LogInAction' ) );
	// $dispatcher -> dispatch( new QPage_Action() );
	// ...
	
?>