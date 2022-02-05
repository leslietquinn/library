<?php

	/**
	 * @package		record
	 * @subpackage	filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 */
	 
	interface QRecord_Interface extends QFilter_Interface {
		public function insert() : void;
		public function update() : void;
		public function delete() : void;
	}
	
?>