<?php

	/**
	 * @package		transactions
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 */
	 
	interface QTransaction_Interface {
		public function rollback();
		public function commit();
		public function begin();
	}
	
?>