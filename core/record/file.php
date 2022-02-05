<?php

	/**
	 * @package		record
	 * @subpackage	dataspace
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @abstract
	 */
	 
	abstract class QRecord extends QDataspace implements QRecord_Interface {
		protected $primary_keys = array( 'id' );
		
		/** 
		 * Load record with data based upon a PK if present
		 *
		 * @param	$id					string
		 * 
		 * @return						void
		 * @access						public
		 */
		 
		public function __construct( string $id ) {
			if( $id ) {
				$this -> load( $id ); 
			}
		}
		
		/**
		 * Accept a separate structure for data transfer to class
		 *
		 * @param	$acceptable			object	typically typeof QDataspace_Interface
		 *
		 * @access						public
		 * @return						void
		 * @throws						QRecord_Exception
		 */
		 
		public function push( $acceptable ) {
			if( !$acceptable instanceof QDataspace_Interface ) {
				throw new QRecord_Exception( 'thrown exception: expecting QDatabase_Interface [core/record]' );
			}
			
			foreach( $this -> parameters as $k => $v ) {
				if( $acceptable -> has( $k ) ) {
					$this -> set( $k, $acceptable -> get( $k ) );
				} 
			}
		}
		
		/**
		 * Load row of data based on a given PK
		 *
		 * @param	$id		mixed string | array
		 *
		 * @access	protected
		 * @return	void
		 */
		 
		protected function load( $id ) : void {
			$stmt = $this -> getConnection() -> fetch( $this -> loadStatement() );
			if( is_array( $id ) ) {
				
				// allow for multiple keys
				$count = 1;
				foreach( $id as $key ) {
					
					/**
					 * @note	make the assumption we are dealing with a string 
					 *			type, by default and treat integers as a string
					 *
					 */
					 
					$stmt -> bindString( $count, $key );
					$count++;
				}
			} else {
				// treat integers as strings as mysql seams to allow this
				$stmt -> bindString( 1, strval( $id ) );
			}
			
			$rs = $stmt -> execute();
			if( $row = $rs -> getRow() ) {
				foreach( array_keys( $this -> parameters ) as $parameter ) {
					$this -> parameters[$parameter] = $row[$parameter];
				}
			}
		}
		
		/**
		 * Insert row of data to resource type
		 *
		 * @access			public
		 * @return			void
		 * @throws			QDb_Exception
		 */
		 
		public function insert() : void {
			$stmt = $this -> getConnection() -> fetch( $this -> insertStatement() ); 
			
			$count = 1;
			foreach( array_keys( $this -> parameters ) as $parameter ) { 
				$stmt -> bindString( $count, $this -> get( $parameter ) ); 
				$count++;
			}
			
			$stmt -> insert();
			if( $error = $this -> getConnection() -> error() ) { 
				throw new QDb_Exception( $error );
			}
		}
		
		/**
		 * Update row of data to resource type
		 * 
		 * @access	public
		 * @return 	void
		 * @throws			QDb_Exception
		 */
		 
		public function update() : void {
			$stmt = $this -> getConnection() -> fetch( $this -> updateStatement() );
			
			$count = 1;
			foreach( array_keys( $this -> parameters ) as $parameter ) { 
				
				/**
				 * @note	ignore the primary keys at this point
				 *
				 */
				 
				if( !in_array( $parameter, $this -> primary_keys ) ) { 
					$stmt -> bindString( $count, $this -> get( $parameter ) );
					$count++;
				}
			}
			
			foreach( $this -> primary_keys as $key ) {
				$stmt -> bindString( $count, $this -> get( $key ) );
				$count++;
			}
			
			$stmt -> update();
			if( $error = $this -> getConnection() -> error() ) {
				throw new QDb_Exception( $error );
			}
		}
		
		/**
		 * Delete row of data to resource type
		 *
		 * @access 	public
		 * @return	void
		 * @throws			QDb_Exception
		 */
		 
		public function delete() : void {
			$stmt = $this -> getConnection() -> fetch( $this -> deleteStatement() );
			
			$count = 1;
			foreach( $this -> primary_keys as $key ) {
				$stmt -> bindString( $count, $this -> get( $key ) );
				$count++;
			}
			
			$stmt -> delete();
			if( $error = $this -> getConnection() -> error() ) {
				throw new Q_Exception( $error );
			}
		}
		
		/** 
		 * Return a connection resource
		 *
		 * @access	protected
		 * @return	object	typeof QSql_Connection_Interface
		 */
		 
		protected function getConnection() {
			return QRegistry::get( 'connection' );
		}
		
		abstract protected function insertStatement() : string;
		abstract protected function updateStatement() : string;
		abstract protected function deleteStatement() : string;
		abstract protected function loadStatement() : string;
	}
	
?>