<?php

	/**
	 * @package		db
	 * @version		beta-12s, 21-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	/**
	 * Copyright Notice
	 *
	 * Class and class functions [implementation] is the sole ownership and
	 * copyright owner of Leslie Quinn <les.quinn.2012@gmail.com>
	 *
	 * No part of this script, or associated script found within the framework
	 * may be used in any way, in whole or in part without prior written
	 * permission of Leslie Quinn
	 */
	
	final class QDb implements QDb_Interface, QDb_Connection_Interface {
		private $connection = null;
		private $use_pool = false;
		private $pool = null;
		
		const ASCENDING = 'ASC';
		const DESCENDING = 'DESC';
		
		const VARCHAR = 254;
		const TINY_TEXTAREA = 1024;
		const SMALL_TEXTAREA = 8192;
		const MEDIUM_TEXTAREA = 32768;
		const BIG_TEXTAREA = 65536;

		/**
		 * Class constructor
		 *
		 * @param	$use_pool		bool
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function __construct( bool $use_pool = false ) {
			$this -> use_pool = $use_pool;
		}
		
		/**
		 * Initialise the database resource from here
		 *
		 * @param	$config			array
		 * @param	$db				string
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 * @static
		 *
		 * @return			QDb_Connection_Interface
		 * @throws			QDb_Exception
		 */
		 
		static public function factory( array $configs, string $db ) : QDb_Connection_Interface {
			$srce = array_shift( $configs );
			$host = array_shift( $configs );
			$user = array_shift( $configs );
			$pass = array_shift( $configs );
			
			try {
				switch( $db ) {
					case 'mysqli':
						return new QDb_Connection_Mysql( $srce, $host, $user, $pass ); 
						break;
					
					case 'postgre':
						return new QDb_Connection_Postgre( $srce, $host, $user, $pass ); 
						break;
						
					default:
						return new QDb_Connection_Mysql( $srce, $host, $user, $pass ); 
						break;	
				}
			} catch( QDb_Connection_Exception $e ) {
				$this -> getConnection() -> log( $e -> getMessage() );
				
				throw new QDb_Exception( $e -> getMessage() );
			}
		}
		
		/**
		 * Query the database, raw unprepared SQL
		 *
		 * @param	$sql		string
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			object typeof QDb_Resultset_Interface
		 */
		 
		public function query( string $sql ) : QDb_Resultset_Interface {
			return $this -> getConnection() -> query( $sql );
		}
		
		/**
		 * Facilitate access to the database resource
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			object typeof QDb_Connection_Interface
		 * @throws			QDb_Exception
		 */
		 
		public function getConnection() : QDb_Connection_Interface {
			if( QNull::is( $this -> connection ) ) {
				throw new QDb_Exception( 'thrown exception: no database resource found [core/db]' );
			}
			
			return $this -> connection;
		}
		
		/**
		 * Set a database connection
		 *
		 * @param	$connection			object typeof QDb_Connection_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function setConnection( QDb_Connection_Interface $connection ) {
			if( $this -> use_pool ) {
				$this -> getPool() -> setConnection( $connection );
			} else {
				
				/**
				 * @note	we are not interested in storing multiple database 
				 *			resources, so we'll not bother this time
				 *
				 */
				 
				$this -> connection = $connection;
			}
		}
		
		/**
		 * Set up the logger, if need be
		 *
		 * @param 	$logger			object typeof QLogger_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function setLogger( QLogger_Interface $logger ) {
			$this -> getConnection() -> setLogger( $logger );
		}
		
		/**
		 * State which of the pooled databases we are to use, until told otherwise
		 *
		 * @param	$db			string
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			obect typeof QDb_Interface
		 * @throws			QDb_Exception
		 */
		 
		public function using( string $db ) : QDb_Interface {
			if( !$this -> getPool() -> hasConnection( $db ) ) {
				throw new QDb_Exception( 'thrown exception: pool does not have a resource available [core/db]' );
			}
			
			$this -> connection = $this -> getPool() -> getConnection( $db );
			
			return $this;
		}
		
		/**
		 * Return error string if applicable
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			string
		 * @throws 			QDb_Exception
		 */
		 
		public function error() : string {
			try {
				return $this -> getConnection() -> error();
			} catch( QDb_Connection_Exception $e ) {
				$this -> getConnection() -> log( $e -> getMessage() );
				
				throw new QDb_Exception( $e -> getMessage() );
			}
		}
		
		/**
		 * Rollback on a committment made earlier, release changes made
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function rollback() {
			$this -> getConnection() -> rollback();
		}
		
		/**
		 * Commit all transations to the database, or none at all
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function commit() {
			$this -> getConnection() -> commit();
		}
		
		/**
		 * Begin process to allow for transational commits
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function begin() {
			$this -> getConnection() -> begin();
		}
		
		/**
		 * Close down the database resource, preventing further traffic
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function close() {
			$this -> getConnection() -> close();
		}
		
		/**
		 * Toggle (swap around) one value for its opposite
		 *
		 * @param	$variable			string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 * @static
		 *
		 * @return			string
		 */
		 
		static public function toggle( string $variable ) : string { 
			if( $variable == QDb::ASCENDING or $variable == QDb::DESCENDING ) {
				return ( $variable != QDb::ASCENDING ) ? QDb::ASCENDING:QDb::DESCENDING;
			}
			
			if( $variable == 'NULL' or $variable == 'NOT NULL' ) {
				return ( $variable != 'NULL' ) ? 'NULL':'NOT NULL';
			}
			
			return $variable;
		}
		
		/**
		 * Return the pool of database resources
		 *
		 * @access			private
		 * @introduced		2021/11/18
		 *
		 * @return			obect typeof QDb_Pool
		 */
		 
		private function getPool() : QDb_Pool {
			if( QNull::is( $this -> pool ) ) {
				$this -> pool = new QDb_Pool();
			}
			
			return $this -> pool;
		}
	}
	
?>