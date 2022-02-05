<?php

	final class QPage_Handler_Cachable extends QPage_Handler_Decorator {
		protected $use_uri = false;
		
		/**
		 * Class constructor
		 *
		 * @param	$page_handler		object		typeof QPage_Handler_Interface
		 * @param	$use_uri			boolean		true, use uri with page handler id to identify cache
		 *											false, use page handler id only to identify cache
		 *
		 */
		 
		public function __construct( QPage_Handler_Interface $page_handler, $use_uri = true ) {
			parent::__construct( $page_handler );
			$this -> use_uri = $use_uri;
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			if( $ttl = $this -> page_handler -> isCachable() ) {
				if( $this -> use_uri ) {
					$filename = QRegistry::get( 'request' ) -> requestUri().$this -> page_handler -> getId();
				} else {
					// use only handler id for composites that are shared across
					// several pages to prevent duplication
					$filename = $this -> page_handler -> getId();
				}
				$path = QCache::directory().md5( $filename ).'.cache'; 
				
				if( $this -> hasCache( $path, $ttl ) ) {
					return @file_get_contents( $path );
				} else {
					// create previously flushed cache
					ob_start();
					$this -> page_handler -> execute( $dataspace );
					
					$buffered = ob_get_clean();
					@file_put_contents( $path, $buffered, LOCK_EX );
					
					return $buffered;
				}
			}
			
			ob_start();
			$this -> page_handler -> execute( $dataspace );
			return ob_get_clean();
		}
		
		protected function hasCache( string $path, int $ttl ) : bool {
			if( is_file( $path ) ) {
				if( ( time() - $ttl ) < filemtime( $path ) ) {
					// cache ttl still valid
					return true;
				}
				// clear cache as now expired
				$this -> flush( $path );
			}
			// no cache found
			return false;
		}
		
		protected function flush( $path ) {
			@unlink( $path );
		}
	}
	
?>