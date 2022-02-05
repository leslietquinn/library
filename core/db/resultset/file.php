<?php

	final class QDb_Resultset implements QDb_Resultset_Interface {
		private $rs = null;
		
		/**
		 * Class constructor
		 *
		 * @param 	$rs			object
		 *
		 * @access			public
		 * @introduced		2021/11/19
		 *
		 * @return			void
		 */
		 
		public function __construct( object $rs ) {
			$this -> rs = $rs;
		}
		
		/**
		 * Return one row of data
		 *
		 * @access			public
		 * @introduced		2021/11/19
		 *
		 * @return			array
		 */
		 
		public function getRow() : array {
			if( $row = $this -> rs -> fetch_assoc() ) {
				return $row;
			} 
				
			return array();
		}
		
		/**
		 * Return a count on number of rows fetched
		 *
		 * @access			public
		 * @introduced		2021/11/19
		 *
		 * @return			int
		 */
		 
		public function rowCount() : int {
			if( $rows = $this -> rs -> num_rows ) {
				return $rows;
			}
			
			return 0;
		}
		
		/**
		 * Return the number of rows of data impacted by an SQL write
		 *
		 * @access			public
		 * @introduced		2021/11/19
		 *
		 * @return			int
		 */
		 
		public function affectedRows() : int {
			if( $rows = $this -> rs -> affected_rows ) {
				return $rows;
			}
			
			return 0;
		}
		
		/**
		 * Free up memory, flush out data
		 *
		 * @access			public
		 * @introduced		2021/11/19
		 *
		 * @return			bool
		 */
		 
		public function free() : bool{
			if( $this -> rs -> free() ) {
				return true;
			}
			
			return false;
		}
		
	}
	
?>