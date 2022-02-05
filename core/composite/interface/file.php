<?php

	/**
	 * @package		composite
	 * @version		1.0-alpha
	 * @author		les quinn 
	 */
	 
	interface QComposite_Interface {
		public function getId();
		public function getChildren();
		public function hasChildren();
		public function attach( QComposite_Interface $composite );
	}
	
?>