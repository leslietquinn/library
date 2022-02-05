<?php

	final class QDb_Connection_Mysql_Statement implements QDb_Connection_Statement_Interface {
		private $parameters = array();
		private $connection = null;
		private $sql;
		
		/**
		 * Class constructor
		 *
		 * @param	$connection		object typeof QDb_Connection_Interface
		 * @param	$sql			string
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function __construct( QDb_Connection_Interface $connection, string $sql ) {
			$this -> connection = $connection;
			$this -> sql = $sql;
		}
		
		/**
		 * Facilitate access to the loggin mechanism
		 *
		 * @param	$message			string
		 *
		 * @access			public
		 * @introduced		2021/11/19
		 *
		 * @return			object typeof QLogger_Interface
		 */
		 
		public function log( string $message ) {
			$this -> connection -> log( $message );
		}
		
		/**
		 * Execute and return a resultset
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			object typeof QDb_Resultset_Interface 
		 * @throws 			QDb_Exception
		 */
		 
		public function execute() : QDb_Resultset_Interface {
			try {
				
				/**
				 * @note	we need to access the database connection directly, to 
				 *			be able to return the resultset expected
				 *
				 */
				 
				$rs = $this -> connection -> getConnection() -> query( $this -> prepare( $this -> sql ) );
			} catch( QDb_Connection_Exception $e ) {
				$this -> log( $e -> getMessage() );
				
				throw new QDb_Exception( $e -> getMessage() );
			}
			
			return new QDb_Resultset( $rs );
		}
		
		/**
		 * Insert a row of data and return result 
		 *
		 * @access			public
		 * @introduced		2021/11/22
		 *
		 * @return			bool
		 */
		 
		public function insert() : bool {
			
			/**
			 * @note	for INSERT, UPDATE and DELETE, we need to access the 
			 *			database connection directly, and not from the QDb_Connection_Interface, 
			 *			to be able to return a bool result
			 *
			 * @see		QRecord::insert(); et al
			 *
			 */
			 
			if( $this -> connection -> getConnection() -> query( $this -> prepare( $this -> sql ) ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Update a row of data and return result 
		 *
		 * @access			public
		 * @introduced		2021/11/22
		 *
		 * @return			bool
		 */
		 
		public function update() : bool {
			if( $this -> connection -> getConnection() -> query( $this -> prepare( $this -> sql ) ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Delete a row of data and return result 
		 *
		 * @access			public
		 * @introduced		2021/11/22
		 *
		 * @return			bool
		 */
		 
		public function delete() : bool {
			if( $this -> connection -> getConnection() -> query( $this -> prepare( $this -> sql ) ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Prepare the SQL by binding each parameter
		 *
		 * @param	$sql 		string
		 *
		 * @access			private
		 * @introduced		2021/11/19
		 *
		 * @return			string
		 * @throws			QDb_Connection_Statement_Exception
		 */
		 
		private function prepare( string $sql ) : string {
			try {
				
				/**
				 * @note	we'll stick to our own solution rather than
				 *			depend on the mysqli bindings, which are an 
				 *			arse from the elbow anyway
				 *
				 */
				 
				$parts = explode( '?', $sql );
				$sql = $parts[0];
				for( $a = 1; $a < count( $parts ); $a++ ) {
					$sql .= "'".$this -> parameters[$a]."'".$parts[$a];
				} 
				
				return $sql;
			} catch( QDb_Connection_Statement_Exception $e ) {
				$this -> log( $e -> getMessage() );
				
				throw new QDb_Connection_Exception( $e -> getMessage() );
			}
		}
		
		/**
		 * Bind a parameter to the SQL securely
		 *
		 * @param	$position			int
		 * @param	$parameter			string
		 *
		 * @see			QDao_Statement::bindParams();
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function bindString( int $position, string $parameter ) { 
		
			/**
			 * @note	at this point, any TEXT, BLOB column data has been
			 *			base64 encoded, anyway to mitigate any risk
			 *
			 */
			 
			$parameter = mysqli_real_escape_string( $this -> connection -> getConnection(), preg_replace( QExpressions::NON_VISIBLE_CHARS, '', strval( $parameter ) ) );
			$this -> parameters[$position] = $parameter;
		}
		
		/**
		 * Bind a parameter to the SQL securely
		 *
		 * @param	$position			int
		 * @param	$parameter			int
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function bindInteger( int $position, int $parameter ) {
			$this -> parameters[$position] = intval( $parameter );
		}
		
		/**
		 * Bind a parameter to the SQL securely
		 *
		 * @param	$position			int
		 * @param	$parameter			float
		 *
		 * @access			public
		 * @introduced		2021/11/18
		 *
		 * @return			void
		 */
		 
		public function bindFloat( int $position, float $parameter ) {
			$this -> parameters[$position] = floatval( $parameter );
		}
		
	}
	
?>