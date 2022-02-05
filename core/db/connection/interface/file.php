<?php

	interface QDb_Connection_Interface {
		public function rollback();
		public function commit();
		public function begin();
		
		public function query( string $sql );
		public function error();
	}
	
?>