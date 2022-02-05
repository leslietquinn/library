<?php

	final class QDb_Connection_Mysql extends QDb_Connection {
		
		/**
		 * Instantiate a new connection with database
		 *
		 * @param	$srce			string		database to connect to
		 * @param	$host			string		host server
		 * @param	$user			string		
		 * @param	$pass			string
		 *
		 * @access				public
		 * @introduced			2021/11/18
		 *
		 * @return				void
		 * @throws			QDb_Connection_Exception
		 */
		 
		public function __construct( string $srce, string $host, string $user, string $pass ) { 
			$this -> connection = new mysqli( $host, $user, $pass, $srce );
			
			if( $this -> connection -> connect_errno ) {
				
				/**
				 * @note	require to log this error
				 *
				 */
				
				$this -> log( $this -> connection -> connect_error );
				
				throw new QDb_Connection_Exception( 'thrown exception: unable to access database, error found [core/db/connection/mysql] 32' );
			}
			
			if( $this -> isolate() ) {
					
				/**
				 * @note	allow 4 byte unicode (utf8) characters, default is 3 byte
				 *
				 *			- http://codeascraft.etsy.com/2013/03/19/the-perils-of-sql_mode/
				 *
				 */
					 
				$this -> connection -> query( 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci' );
				$this -> connection -> query( 'SET COLLATION_CONNECTION utf8mb4_unicode_ci' );
				$this -> connection -> query( 'SET CHARACTER SET utf8mb4' );
						
				$this -> report( MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT );
			}
		}
		
		/**
		 * Facilitate the means to query the database, return a resultset
		 *
		 * @param	$sql 			string
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			object typeof QDb_Connection_Statement_Interface
		 */
		
		public function fetch( string $sql ) : QDb_Connection_Statement_Interface {
			return new QDb_Connection_Mysql_Statement( $this, $sql );
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
		 * @throws			QDb_Connection_Exception
		 */
		 
		public function query( string $sql ) : QDb_Resultset_Interface {
			$rs = $this -> connection -> query( $sql );
			if( $error = $this -> connection -> error ) {
				$this -> log( $error ); 
				
				throw new QDb_Connection_Exception( 'thrown exception: expected object not given [core/db/connection/mysql] ('.$error.') 84' );
			}
			
			return new QDb_Resultset( $rs );
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
			if( $this -> connection -> query( 'rollback' ) ) {
				return true;
			}
			
			return false;
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
			if( $this -> connection -> query( 'commit' ) ) {
				return true;
			}
			
			return false;
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
			if( $this -> connection -> query( 'start transaction' ) ) {
				return true;
			}
			
			return false;
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
			if( $this -> connection -> close() ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Return the identity of this resource
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			string
		 */
		
		public function identity() {
			return 'mysqli';
		}
		
		/**
		 * Return error string if applicable
		 *
		 * @access					public
		 *
		 * @return					string
		 */
		 
		public function error() : string {
			if( $this -> connection -> errno ) { 
				
				/**
				 * @note	[0]['errno']
				 *			[0]['sqlstate']
				 *			[0]['error']
				 *
				 */
				 
				$errors = $this -> connection -> error_list;
				$this -> log( $message = $errors[0]['errno'].' '.$errors[0]['sqlstate'].' '.$errors[0]['error'] );
				
				return $message;
			}
			
			return '';
		}
		
		/**
		 * Set transactional isolation level
		 *
		 * @access			protected
		 * @introduced		2021/11/18
		 *
		 * @see		https://blog.ionelmc.ro/2014/12/28/terrible-choices-mysql/
		 *
		 * @return			bool
		 */
		 
		protected function isolate() : bool { 
			if( $this -> connection -> query( 'set session transaction isolation level serializable' ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Define report level
		 *
		 * @param	$report_level		string
		 *
		 * @access			protected
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		protected function report( $report_level ) {
			$this -> connection -> report_mode = $report_level;
		}
		
	}
	
?>