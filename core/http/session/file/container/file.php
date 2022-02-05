<?php

	final class QHttp_Session_File_Container implements QHttp_Session_Interface {
		private $path;

		public function __construct() {}
		
		public function open( $path ) { 
			$this -> path = $path;
			
			if( !is_dir( $this -> path ) ) { 
				mkdir( $this -> path, 0777 );
			} 

			return true;
		}

		public function close() { 
			return true;
		}

		public function read( $session ) { 
			return (string) @file_get_contents( $this -> path.'/sess_'.$session );
		}

		public function write( $session, $data ) { 
			return @file_put_contents( $this -> path.'/sess_'.$session, $data ) === false ? false : true;
		}

		public function destroy( $session ) { 
			$file = $this -> path.'/sess_'.$session;
			if( file_exists( $file ) ) {
				unlink( $file );
			}

			return true;
		}

		public function gc( $maxlifetime ) {
			foreach( glob( $this -> path.'/sess_*' ) as $session ) {
				$file = new QFile( $session );
				
				if( $file -> isFile() ) {
					$modification = filemtime( $session );
					if( ( $modification + $maxlifetime ) < time() ) {
						$file -> remove();
					}
				}
			}

			return true;
		}
	}

?>