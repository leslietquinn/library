<?php

	/**
	 * @package		front controller
	 * @subpackage	action dispatcher
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @abstract
	 */
	 
	abstract class QFront_Controller_Action_Dispatcher implements QFront_Controller_Action_Dispatcher_Interface {
		public function __construct() {}
		
		public function execute( QFront_Controller_Dispatcher_Interface $dispatcher ) {
			$action = $dispatcher -> formatActionName( $dispatcher -> requestParameter( 'action' ) );
			
			if( !method_exists( $this, $action ) ) {
				throw new QFront_Controller_Action_Dispatcher_Exception(
					'thrown exception: [action] unknown action ('.$dispatcher -> requestParameter( 'controller' ).'::'.$action.') [core/front/controller/action/dispatcher] 18' 
				);
			} 
			
			/** 
			 * @note 	return the QPage_Handler_Interface in question
			 */
			
			return $this -> $action();
		}
		
		abstract public function showAction();
	}
	
?>