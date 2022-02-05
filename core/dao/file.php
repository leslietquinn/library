<?php
	
	/**
	 * @package		dao (data access object)
	 * @version		beta-05f, 06;09-revised
	 * @author		les quinn 
	 */
	 
	abstract class QDao implements QDao_Interface {
		protected $cache = null;
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/11/03
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Delegate sql query to database abstraction layer
		 *
		 * @param	$sql		string		sql query to perform
		 *
		 * @access				public
		 * @introduced			2021/11/03
		 *
		 * @return				object typeof QDb_Resultset_Interface
		 * @throws			QDb_Exception 
		 */
		 
		public function fetch( string $sql ) : QDb_Resultset_Interface { 
			
			
			/**
			 * @note	SQL parameters must be prepared elsewhere, before 
			 *			calling on this function
			 *
			 */
			
			try {
				$result = $this -> getConnection() -> query( $sql );
			} catch( QDb_Connection_Exception $e ) {
				throw new QDb_Exception( $e -> getMessage() );
			}
			
			return $result;
		}
 
		/**
		 * Return generic access to database resource
		 *
		 * @access				public
		 *
		 * @return				object typeof QDb_Connection_Interface
		 */
		 
		public function getConnection() : QDb_Connection_Interface {
			return QRegistry::get( 'connection' );
		}
		
		/**
		 * Return a generic TTL (time to live) for file caching
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 *
		 * @return			int
		 */
		 
		public function isCachable() : int {
			return QCache::NO_CACHE;
		}
	}
	
?>