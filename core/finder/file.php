<?php

	abstract class QFinder implements QFinder_Interface {
		protected $statement = null;
		protected $filters;
		
		public function __construct( QFinder_Statement_Interface $statement ) {
			$this -> statement = $statement;
			$this -> filters = array();
		}
		
		public function addFilter( QFilter_Interface $filter ) {
			$this -> filters[] = $filter;
		}
		
		/**
		 * Return a recordset as array of objects
		 *
		 * @param 	$rs				object	database facilities
		 *
		 * @access				protected
		 * @return					array	returns an array of objects
		 */
		 
		protected function loadAll( $rs ) {
			$records = array();
			while( $record = $rs -> getRow() ) {
				$records[] = $this -> load( $record, $this -> getClassname() );
			}
			return $records;
		}
		
		/**
		 * Return one record as an object
		 *
		 * @param 	$rs				object	database facilities
		 *
		 * @access				protected
		 * @return					object	returns an object
		 */
		 
		protected function loadOne( $rs ) {
			return $this -> load( $rs -> getRow(), $this -> getClassname() );
		}
		
		/**
		 * Facilities to create recordset from database resource
		 *
		 * @param 	$row			array	represents a row of data
		 * @param	$classname		string
		 *
		 * @access				protected
		 * @return					object	returns an object
		 */
		 
		protected function load( $row, $classname ) {
			$record = new $classname();
			foreach( (array) $row as $k => $v ) {
				$record -> set( $k, $v );
			}
			return $record;
		}
		
		/**
		 * Facilitate the filtering of data results
		 *
		 * @param	$records		array	represents 1..n data rows
		 *
		 * @access				protected
		 * @return	$records		array
		 */
		 
		protected function process( $records ) {
			foreach( $this -> filters as $filter ) {
				if( is_array( $records ) ) {
					foreach( $records as $record ) {
						$filter -> process( $record );
					}
				} else {
					// cater for single row of data too
					$filter -> process( $records );
				}
			}
			return $records;
		}
		
		protected function getConnection() {
			return QRegistry::get( 'connection' );
		}
		
		protected function getStatement() {
			return $this -> statement;
		}
		
		abstract protected function getClassname();
	}
	
?>