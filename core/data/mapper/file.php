<?php

	abstract class QData_Mapper {
		protected $filters;
		
		public function __construct() {
			$this -> filters = array();
		}
	
		protected function getConnection() {
			return QRegistry::get( 'connection' );
		}
		
		public function addFilter( QFilter_Interface $filter ) {
			$this -> filters[] = $filter;
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
		
		/**
		 * Return a recordset as array of objects
		 *
		 * @param 	$rs				object	database facilities
		 * @param	$class			string
		 *
		 * @access				protected
		 * @return					array	returns an array of objects
		 */
		 
		protected function loadAll( $rs, $class ) {
			$records = array();
			while( $record = $rs -> getRow() ) {
				$records[] = $this -> load( $record, new $class );
			}
			
			return $records;
		}
		
		/**
		 * Return one record as an object
		 *
		 * @param 	$rs				object	database facilities
		 * @param	$class			string
		 *
		 * @access				protected
		 * @return					object	returns an object
		 */
		 
		protected function loadOne( $rs, $class ) {
			return $this -> load( $rs -> getRow(), new $class );
		}
		
		/**
		 * Facilities to create recordset from database resource
		 *
		 * @param 	$row			array	represents a row of data
		 * @param	$class			object typeof QDataspace_Interface
		 *
		 * @access				protected
		 * @return					object	returns an object
		 */
		 
		protected function load( $row, $class ) {
			foreach( (array) $row as $k => $v ) {
				$class -> set( $k, $v );
			}
			
			return $class;
		}
		
	}
	
?>