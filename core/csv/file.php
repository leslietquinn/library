<?php

	final class QCsv extends QIterator {
		const STANDARD_LINE = 2048;
		
		/**
		 * Class constructor
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/17
		 *
		 * @return			void
		 */
		 
		public function __construct( QDataspace_Interface $dataspace ) {
			parent::__construct( $dataspace );
		}
		
		/**
		 * Return a set of generic settings 
		 *
		 * @access 			public
		 * @introduced		2021/11/17
		 * @static
		 *
		 * @return			array
		 */
		 
		static public function settings() : array {
			return array( ',', '"', '"' );
		}
		
	}
	
?>