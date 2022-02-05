<?php

	/**
	 * @package		action
	 * @version		beta-01e, 06;-dev
	 * @author		les quinn 
	 */
	 
	abstract class QAction implements QAction_Interface {
		public function __construct() {}
		
		public function getActionName() {
			return $this -> action_name;
		}
		
		public function getControllerName() {
			return $this -> controller_name;
		}
		
		public function isSecure() {
			// by default, private access
			return false; 
		}
		
		abstract public function execute();
	}
	
	/* example of use */
	/*class QPage_Action extends QAction {
		public function __construct() {}
		
		public function execute() {
			$page = new QPage_Action_Handler();
			$page -> attach( $body = new QBody_Action_Handler() );
			$page -> attach( $header = new QHead_Action_Handler() );
			return $page;
		}
	}
	
	// ...
	
	class QPage_Action_Handler extends QAction_Handler {
		public function __construct() {
			$this -> id = 'page';
		}
		
		public function execute() {
			return file_get_contents( '... fetch template file ...' );
		}
	}
	
	// ...
	
	class QAction_Rule_Log_In extends QAction_Decorator {
		public function __construct( $decorated ) {
			parent::__construct( $decorated );
		}
		
		public function execute() {
			// ...
			
			if( ... session hash found ... ) {
				if( $record -> hasCredentials( $username, $password ) ) {
					return $this -> decorated -> execute();
				}
			}
			
			// redirect...
		}
	}
	
	$dispatcher = new QAction_Dispatcher();
	$dispatcher -> attach( new QAction_Rule( 'QAction_Rule_Log_In' ) );
	$page = $dispatcher -> dispatch( new QPage_Action() );
	
	*/
	
?>