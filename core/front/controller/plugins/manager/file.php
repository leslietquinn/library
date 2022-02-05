<?php

	/**
	 * @package		front controller
	 * @subpackage	plugin 
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 * @ignore
	 */
	 
	final class QFront_Controller_Plugins_Manager implements QFront_Controller_Plugins_Manager_Interface {
		private $plugins = array();
		
		public function __construct() {}
		
		public function addPlugin( QFront_Controller_Plugins_Interface $plugin ) {
			$this -> plugins[] = $plugin; 
		}
		
		public function preProcess() { 
			try {
				foreach( $this -> plugins as $plugin ) { 
					$plugin -> preProcess();
				}
			} catch( QFront_Controller_Plugins_Exception $e ) {
				throw new QFront_Controller_Dispatcher_Exception( $e -> getMessage() );
			}
		}
		
		public function postProcess() {
			try {
				foreach( array_reverse( $this -> plugins ) as $plugin ) {
					$plugin -> postProcess();
				}
			} catch( QFront_Controller_Plugins_Exception $e ) {
				throw new QFront_Controller_Dispatcher_Exception( $e -> getMessage() );
			}
		}
	}
	
?>