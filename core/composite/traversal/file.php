<?php

	class QComposite_Traversal implements QComposite_Traversal_Interface {
		protected $root = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$collection			array	
		 * @param	$walk				boolean		traverse array structure or not 
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function __construct( $collection, $walk = true ) {
			$this -> root = new QComposite_Item( array_shift( $collection ) );
			
			if( $walk ) {
				$this -> walk( $collection );
			}
		}
		
		public function getRoot() {
			return $this -> root;
		}
		
		/**
		 * Walk an array to create a structure
		 *
		 * @param	$collection		array	
		 * @return					object	typeof QComposite_Interface
		 */
		 
		public function walk( $collection ) {
			foreach( $collection as $item ) {
				if( $tmp = $this -> traverse( $this -> root, $item ) ) {
					$tmp -> attach( $c = new QComposite_Item( $item ) );
					
					// set $composite parent
					// $c -> setParent( $tmp );
				}
			}
		}
		
		/**
		 * Construct a composite between a child <> parent relation
		 *
		 * @param	$composite		object		expects QComposite_Interface type
		 * @param	$item			array		expects an associative array item
		 *
		 * @return	object		QComposite_Interface object
		 */
		 
		protected function traverse( QComposite_Interface $composite, QDataspace_Interface $item ) { 
			if( $composite -> getId() == $item -> get( 'parent' ) ) {
				return $composite;
			} else {
				if( $composite -> hasChildren() ) {
					$children = $composite -> getChildren();
					
					foreach( $children as $child ) {
						if( $tmp = $this -> traverse( $child, $item ) ) {
							$tmp -> attach( $c = new QComposite_Item( $item ) );
		
							// leave here for reference
							// set $composite parent
							// $c -> setParent( $tmp );
						}
					}
				}
			}
		}
		
	}
	
?>