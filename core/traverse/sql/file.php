<?php

	final class QTraverse_Sql extends QTraverse {
		protected $items = array();
		
		/**
		 * Class constructor
		 *
		 * @param	$items			array
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			void
		 */
		 
		public function __construct( array $items ) {
			parent::__construct();
			
			$this -> items = $items;
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
		 * @throws			QTraverse_Exception
		 */
		 
		public function walk( QAcceptee_Interface $acceptee ) {
			foreach( $this -> items as $item ) { 
				
				/**
				 * @note	sanity check, be sure we have a QDataspace_Interface 
				 *			for each node
				 *
				 */
				 
				if( $item instanceof QDataspace_Interface ) {
					try {
						$acceptee -> push( $item );
					} catch( QTraverse_Adapter_Exception $e ) {
						throw new QTraverse_Exception( $e -> getMessage() );
					}
					
					$walker = new QTraverse_Sql( QTraverse_Sql_Factory::query( $item ) );
					$walker -> walk( $acceptee );
				} else {
					throw new QTraverse_Exception( 'thrown exception: illegal interface found for node [code/traverse/sql]' );
				}
            }
		}
		
	}
	
?>