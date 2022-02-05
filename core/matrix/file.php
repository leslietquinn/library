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
	
	final class QMatrix {
		private array $rows;
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			void
		 */
		 
		public function __construct() {
			$this -> rows = array();
		}
		
		/**
		 * Add a row to the matrix
		 *
		 * @param	$row		object typeof QMatrix_Row_Interface
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			object typeof QMatrix_Interface
		 */
		 
		public function addRow( QMatrix_Row_Interface $row ) : QMatrix_Interface {
			$this -> rows[] = $row;
		
			return $this;
		}
		
		/**
		 * Add a column to the matrix
		 *
		 * @param	$column		array
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			object typeof QMatrix_Interface
		 */
		 
		public function addColumn( QMatrix_Column_Interface $column ) : QMatrix_Interface {
			foreach( $this -> rows as $row ) {
				$row -> addColumn( $column );
			}
		
			return $this;
		}

		/**
		 * Return the number of rows found in the matrix
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			int
		 */
		 
		public function rows() : int {
			return count( $this -> rows );
		}

		/**
		 * Return one row only, as specified
		 *
		 * @param	$row 		int 
		 * 
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			object typeof QMatrix_Row_Interface
		 * @throws			QMatrix_Exception
		 */
		 
		public function row( int $row ) : QMatrix_Row_Interface {
			if( !isset( $this -> rows[$row] ) ) {
				throw new QMatrix_Exception( 'thrown exception: row count issue [core/matrix] 101' );
			}

			return $this -> rows[$row];
		}

		/**
		 * Add one or more filters to the grid
		 *
		 * @param	$filter			object typeof QFilter_Interface 
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			object typeof QMatrix_Interface
		 */
		 
		public function addFilter( QFilter_Interface $filter ) : QMatrix_Interface {
			foreach( $this -> rows as $row ) {
				
				/**
				 * @note	interate over each row, allowing for a filter 
				 *			to be added to each column QDataspace_Interface 
				 *			container
				 */
				 
				$row -> addFilter( $filter );
			}
			
			return $this;
		}
		
		/**
		 * Return the cell for a given position
		 *
		 * @param	$row			int
		 * @param	$column			int
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			object typeof QDataspace_Interface
		 * @throws			QMatrix_Exception
		 */
		 
		public function position( int $row, int $column ) : QMatrix_Cell_Interface {
			if( !isset( $this -> rows[$row] ) ) {
				throw new QMatrix_Exception( 'thrown exception: unsupported row found [core/matrix] 148' );
			}
			
			return $this -> rows[$row] -> getCell( $column );
		}
	}
	
	/** example of use
	$matrix = new QMatrix();
	$matrix 
		-> addRow( new QMatrix_Row() )
		-> addRow( new QMatrix_Row() )
		-> addRow( new QMatrix_Row() )
		-> addRow( new QMatrix_Row() );
	
	$matrix -> addColumn( new QMatrix_Column( 12 ) );
	
	$cell = $matrix -> position( 3, 8 );
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
	
?>