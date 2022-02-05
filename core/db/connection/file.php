<?php

	abstract class QDb_Connection implements QDb_Connection_Interface {
		protected $connection = null;
		protected $logger = null;
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Facilitate access to the database resource
		 *
		 * @access			public
		 * @introduced		2021/11/19
		 *
		 * @return			object
		 */
		 
		public function getConnection() {
			return $this -> connection;
		}
		
		/**
		 * Perform an operation using another responsibility
		 *
		 * @param	$acceptee			object
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function accept( QAcceptee_Interface $acceptee ) {
			
			/**
			 * @note	we may give $acceptee to have the responsibility 
			 *			to create and drop tables, do back up of 
			 *			a database table, and so on
			 *
			 *			at the same time, keeping it separate 
			 *			from $this
			 *
			 */
			 
			$acceptee -> push( $this );
		}
		
		/**
		 * Set up the logger, optional
		 *
		 * @param 	$logger			object typeof QLogger_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function setLogger( QLogger_Interface $logger ) {
			$this -> logger = $logger;
		}
		
		/**
		 * Log an error message
		 *
		 * @param	$message			string
		 *
		 * @access			public
		 * @introduced		2021/11/19
		 *
		 * @return			void
		 */
		 
		public function log( string $message ) {
			if( QNull::not( $this -> logger ) ) {
				$this -> logger -> log( $message );
			}
		}
		
		/**
		 * Return the identity of this resource
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 * @abstract
		 *
		 * @return			string
		 */
		
		abstract public function identity();
		
		/**
		 * Return error string if applicable
		 *
		 * @access					public
		 * @introduced		2021/11/18
		 * @abstract 
		 *
		 * @return					string
		 */
		 
		abstract public function error();
		
		/**
		 * Facilitate the means to query the database, return a resultset
		 *
		 * @param	$sql 			string
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 * @abstract
		 *
		 * @return			object
		 */
		 
		abstract public function fetch( string $sql );
		
	}
	
?>