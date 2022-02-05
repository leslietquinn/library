<?php

	final class QDb_Pool {
		private $pool = null;
		
		/** 
		 * Class constructor 
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function __construct() {
			$this -> pool = array();
		}
		
		/**
		 * Return the requested database resource
		 *
		 * @param	$db			string
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @see				QDb::using();
		 *
		 * @return			object typeof QDb_Connection_Interface
		 * @throws			QDb_Connection_Exception
		 */
		 
		public function getConnection( string $db ) : QDb_Connection_Interface {
			if( !in_array( $db, $this -> pool ) ) {
				throw new QDb_Connection_Exception( 'thrown exception: no database resource found [core/db/pool]' );
			}
			
			return $this -> pool[$db];
		}
		
		/**
		 * Determine if a resource exists or not
		 *
		 * @param	$db			string
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @see				QDb::using();
		 *
		 * @return			bool
		 */
		 
		public function getConnection( string $db ) : bool {
			if( in_array( $db, $this -> pool ) ) {
				return true
			}
			
			return false;
		}
		
		/**
		 * Put a database resource into the pool
		 *
		 * @param	$connection			object typeof QDb_Connection_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function setConnection( QDb_Connection_Interface $connection ) {
			$this -> pool[$connection -> identity()] = $connection;
		}
	}
	
?>