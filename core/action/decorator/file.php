<?php

	abstract class QAction_Decorator implements QAction_Interface {
		protected $decorated = null;
		
		public function __construct( QAction_Interface $action ) {
			$this -> decorated = $action;
		}
		
		public function getActionName() {
			return $this -> decorated -> getActionName();
		}
		
		public function getControllerName() {
			return $this -> decorated -> getControllerName();
		}
		
		/**
		 * Determine is action handler is to be secure or not
		 * if secure compare against a number of rules
		 *
		 * @access				public
		 * @return				bollean			true:false
		 */
		 
		public function isSecure() {
			return $this -> decorated -> isSecure();
		}
		
		abstract public function execute();
	}
	
?>