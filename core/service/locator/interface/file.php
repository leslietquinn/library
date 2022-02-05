<?php

	interface QService_Locator_Interface {
		public function register( QService_Factory_Interface $factory );
		public function has( string $service );
		public function get( string $service );		
	}
	
?>