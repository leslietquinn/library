<?php

	interface QListener_Events_Interface {
		public function receive( QListener_Interface $listener, QDataspace_Interface $dataspace );
	}
	
?>