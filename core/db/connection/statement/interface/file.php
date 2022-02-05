<?php

	interface QDb_Connection_Statement_Interface {
		public function execute();
		public function bindFloat( int $position, float $parameter );
		public function bindInteger( int $position, int $parameter );
		public function bindString( int $position, string $parameter );		
	}
	
?>