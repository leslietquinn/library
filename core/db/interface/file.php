<?php

	interface QDb_Interface {
		public function setConnection( QDb_Connection_Interface $connection );
		public function getConnection();
	}
	
?>