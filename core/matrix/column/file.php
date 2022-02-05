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
	
	final class QMatrix_Column implements QMatrix_Column_Interface {
		private int $size;
		
		/**
		 * Class constructor
		 *
		 * @param	$size			int
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			void
		 */
		 
		public function __construct( int $size ) {
			$this -> size = $size;
		}
		
		/**
		 * Return the size, depth of a column
		 *
		 * @access			public
		 * @introduced		2021/12/16
		 *
		 * @return			int
		 */
		 
		public function sizeOf() : int {
			return $this -> size;
		}
		
	}
	
?>