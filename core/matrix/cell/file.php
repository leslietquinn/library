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
	
	final class QMatrix_Cell extends QDataspace implements QMatrix_Cell_Interface {
		protected $row = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$row			object typeof QMatrix_Row_Interface
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			void
		 */
		 
		public function __construct( QMatrix_Row_Interface $row ) {
			$this -> row = $row;
			parent::__construct();
		}
		
		/**
		 * Return the row to which this cell belongs to
		 * 
		 * @access			public
		 * @introduced		2021/12/16
		 * 
		 * @return			array
		 */

		public function getRow() : array {
			return $this -> row;
		}
	}
	
?>