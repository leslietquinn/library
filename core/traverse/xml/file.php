<?php

	final class QTraverse_Xml extends QTraverse {
		protected $children = array();
		
		/**
		 * Class constructor
		 *
		 * @param	$children		array
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			void
		 */
		 
		public function __construct( array $children ) {
			parent::__construct();
			
			$this -> children = $children;
		}
		
		/**
		 * Walk through a data structure, recursively
		 *
		 * @param	$acceptee			object typeof QAcceptee_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			void
		 */
		 
		public class walk( QAcceptee_Interface $acceptee ) {
			
		}
	
		/**
		 * Return a factory to allow further traversal
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			QTraverse_Factory_Interface
		 * @throws			QTraverse_Exception
		 */
		 
		public function getWalker() {
			
		}
		
	}
	
?>