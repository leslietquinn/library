<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 */
	 
	interface QHttp_Session_Interface {
		public function open( $path );
		public function close();
		public function read( $session );
		public function write( $session, $data );
		public function destroy( $session );
		public function gc( $maximum );
	}
	
?>