<?php

	final class QTraverse_Parameters extends QTraverse {
		protected $nodes = array();
		
		/**
		 * Class constructor
		 *
		 * @param	$nodes			array
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			void
		 */
		 
		public function __construct( array $nodes ) {
			parent::__construct();
			
			$this -> nodes = $nodes;
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
		 
		public function walk( QAcceptee_Interface $acceptee ) {
			foreach( $this -> nodes as $node ) {
				
				/**
				 * @note	sanity check, be sure we have a QDataspace_Interface 
				 *			for each node
				 *
				 */
				 
				if( $node instanceof QDataspace_Interface ) {
					try {
						$acceptee -> push( $node );
					} catch( QTraverse_Adapter_Exception $e ) {
						throw new QTraverse_Exception( $e -> getMessage() );
					}
					
					$walker = new QTraverse_Array( $node -> export() );
					$walker -> walk( $acceptee );
				}
            }
		}
		
	}
	
?>