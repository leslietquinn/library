<?php

	interface QAction_Dispatcher_Interface {
		public function attach( QAction_Rule_Interface $rule );
		public function dispatch( QAction_Interface $action );
	}
	
?>