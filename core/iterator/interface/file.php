<?php

	interface QIterator_Interface {
		public function rewind();
		public function valid();
		public function next();
		
		public function current();
		public function key();
	}
	
?>