<?php

	final class QDao_Cache {
		private $dao = null;
		private $cache;
		
		/**
		 * Class constructor
		 *
		 * @param	$dao		object typeof QDao
		 *
		 * @access			public
		 * @introduced		2021/12/08
		 *
		 * @return			void
		 */
		 
		public function __construct( QDao $dao ) {
			$this -> dao = $dao;
		}
		
		/**
		 * Fetch data, either from the cache or from source
		 *
		 * @param	$sql			string
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 *
		 * @return			mixed
		 * @throws			QFront_Controller_Exception
		 */
		 
		public function fetch( string $sql ) : array {
			if( $ttl = $this -> dao -> isCachable() ) {
				$path = $this -> hash( $sql );
				$file = new QFile( dirname( $path ) );
				
				if( !$file -> isDirectory() ) {
					throw new QFront_Controller_Exception( 'thrown exception: cache directory not found [core/dao/cache] 39' );
				}
				
				if( $this -> hasCache( $path, $ttl ) ) {
					$stack = new QStack();
					return $stack -> grab( $path );
				} else {
					$rs = $this -> dao -> fetch( $sql );
					
					$rows = array();
					while( $row = $rs -> getRow() ) {
						$rows[] = new QParameters( $row );
					}
					
					$stack = new QStack();
					$stack -> put( $rows, $path );
					
					return $rows;
				}
			}
			
			/**
			 * @note	there is no need to cache this data, or access 
			 *			it from a cache so fetch data as per normal
			 */
			 
			$rs = $this -> dao -> fetch( $sql );
			
			$rows = array();
			while( $row = $rs -> getRow() ) {
				$rows[] = new QParameters( $row );
			}
					
			return $rows;
		}
		
		/**
		 * Determine if file is stale or not, delete if so otherwise use it
		 *
		 * @param	$path			string
		 * @param	$ttl			int
		 *
		 * @access			private
		 * @introduced		2021/12/15
		 *
		 * @return			bool
		 */
		 
		private function hasCache( string $path, int $ttl ) : bool {
			if( is_file( $path ) ) {
				if( ( time() - $ttl ) < filemtime( $path ) ) {
					return true;
				}
				
				/**
				 * @note	cache is too old, so remove it
				 */
				 
				$this -> flush( $path );
			}
			
			return false;
		}
		
		/**
		 * Remove a stale cache
		 *
		 * @param	$path			string
		 *
		 * @access			private
		 * @introduced		2021/12/15
		 *
		 * @return			void
		 */
		 
		private function flush( $path ) : void {
			@unlink( $path );
		}
		
		/**
		 * Create the cache file path, based on the SQL uniqueness
		 *
		 * @param 	$sql		string
		 *
		 * @access			private
		 * @introduced		2021/12/15
		 *
		 * @return			string
		 */
		 
		private function hash( string $sql ) : string {
			return QCache::directory().md5( $sql ).'.cache';
		}
	}
	
?>