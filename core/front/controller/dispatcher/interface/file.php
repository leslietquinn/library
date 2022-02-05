<?php

	/**
	 * @package		front controller
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 */
	 
	interface QFront_Controller_Dispatcher_Interface {
		public function setApplicationDirectory( $directory );
		public function getApplicationDirectory();
		public function dispatch();
	}
	
?>