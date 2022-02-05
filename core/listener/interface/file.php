<?php

	interface QListener_Interface {
		public function add( QListener_Events_Interface $event );
		public function remove( QListener_Events_Interface $event );
		public function trigger( QDataspace_Interface $dataspace );
	}
	
?>