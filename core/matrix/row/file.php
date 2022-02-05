<?php

	/**
	 * @package		matrix
	 * @subpackage	dataspace
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @abstract
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
	
	final class QMatrix_Row implements QMatrix_Row_Interface {
		private array $filters;
		private array $cells;
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			void
		 */
		 
		public function __construct() {
			$this -> cells = array();
		}
		
		/**
		 * Add columns to a row
		 *
		 * @param	$column			object typeof QMatrix_Column_Interface
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			void
		 */
		 
		public function addColumn( QMatrix_Column_Interface $column ) : void {
			for( $c = 0; $c < $column -> sizeOf(); $c++ ) {
				$this -> cells[] = new QMatrix_Cell( $this );
			}
		}
		
		/**
		 * Return number of columns
		 * 
		 * @access			public
		 * @introduced		2021/12/16
		 * 
		 * @return			int
		 */

		public function sizeOf() : int {
			return count( $this -> cells );
		}

		/**
		 * Add a filter, all cells
		 *
		 * @param	$filter			object typeof QFilter_Interface 
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			void
		 */
		 
		public function addFilter( QFilter_Interface $filter ) : void {
			foreach( $this -> cells as $cell ) {
				$cell -> addFilter( $filter );
			}
		}
		
		/**
		 * Get a cell, return its container
		 *
		 * @param	$column			int
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			object typeof QMatrix_Cell_Interface
		 * @throws 			QMatrix_Row_Exception
		 */
		 
		public function getCell( int $column ) : QMatrix_Cell_Interface {
			if( !$this -> cells[$column] instanceof QMatrix_Cell_Interface ) {
				throw new QMatrix_Row_Exception( 'thrown exception: cell not properly formed [core/matrix/row] 100' );
			}
			
			return $this -> cells[$column];
		}
		
	}
	
?>