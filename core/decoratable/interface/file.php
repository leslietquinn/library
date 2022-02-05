<?php
	
	interface QDecoratable_Interface {
		public function decorate( QDecoratable_Interface $object );
		public function getDecorated();
	}
	
?>