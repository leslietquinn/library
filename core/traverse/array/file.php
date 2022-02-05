<?php

	final class QTraverse_Array extends QTraverse {
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
			
			/**
			 * @note	there is no need to use associative arrays, because
			 *			if you need the key, put the key in with the rest of the 
			 *			data, that way
			 *
			 */
			 
			foreach( $this -> nodes as $node ) {
				
				/**
				 * @note	sanity check, be sure we have an array
				 *			for each node
				 *
				 */
				 
				if( is_array( $node ) ) {
					try {
						$acceptee -> push( $node );
					} catch( QTraverse_Adapter_Exception $e ) {
						throw new QTraverse_Exception( $e -> getMessage() );
					}
					
					$walker = new QTraverse_Array( $node );
					$walker -> walk( $acceptee );
				}
            }
		}
		
	}
	
?>