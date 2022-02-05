<?php

	class QAction_Dispatcher implements QAction_Dispatcher_Interface {
		protected $rules = array();
		
		public function __construct() {}
		
		/**
		 * Attach one or more rules to given action if required to be secure
		 *
		 * @param	$rule			object		typeof QAction_Rule_Interface
		 *
		 * @return					void
		 */
		 
		public function attach( QAction_Rule_Interface $rule ) {
			$this -> rules[] = $rule;
		}
		
		/**
		 * Dispatch a response from an action once applied appropriate rules
		 *
		 * @param	$action			object		typeof QAction_Interface
		 *
		 * @return					object		a composite structure
		 */
		 
		public function dispatch( QAction_Interface $action ) {
			foreach( $this -> rules as $rule ) {
				// sanity check
				if( $rule instanceof QAction_Rule_Interface ) {
					if( !$rule -> isAllowed( $action ) ) {
						// decorate this action with a rule
						$action = $rule -> applyRule( $action );
					}
				}
			}
			
			// return composite action
			return $action -> execute();
		}
	}
	
?>