<?php

	/**
	 * @package		front controller
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 */
	 
	interface QFront_Controller_Interface {
		public function setApplicationDirectory( string $directory ) : QFront_Controller_Interface;
		public function run();
	}
	
?>