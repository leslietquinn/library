<?php

	interface QAction_Rule_Interface {
		public function applyRule( QAction_Interface $action );
		public function isAllowed( QAction_Interface $action );
	}
	
?>