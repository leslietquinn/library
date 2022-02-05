<?php
	
	abstract class QTraverse implements QTraverse_Interface {
		protected $walker = null;
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Return a structure containg depth and parent relation to child, non associative array
		 *
		 * @param	$datasource			array
		 *
		 * @note		structure that is non associative, for example 
		 *				array( 0 => 'Animals & Pet Supplies', 1 => 'Pet Supplies ', 2 => 'Small Animal Supplies', 3 => 'Small Animal Habitats & Cages' );
		 *
		 * @access			public
		 * @introduced		2021/11/28
		 * @static
		 *
		 * @return			array
		 */
		 
		static public function lineItem( array $item ) : array {
			$parent = 0;
			$line = array();
			foreach( $item as $child => $value ) {
				$line[] = array(
					'line'		=>	trim( $value ),
					'depth'		=> 	$child,
					'parent'	=>	$parent,
				);
				
				/**
				 * @note	the parent is the current $child, but it'll be 
				 *			the previous one before the next $child in the 
				 *			interation; making it a $parent in due course
				 */
				 
				$parent = $child;
			}
			
			return $line;
		}
		
		/**
		 * Return the highest depth, made in comparison to existing
		 *
		 * @param	$datasource			array
		 * @param	$depth				int
		 *
		 * @access			public
		 * @introduced		2021/11/28
		 * @static
		 *
		 * @return			int
		 */
		 
		static public function depth( array $datasource, int $depth ) : int {
			if( sizeof( $datasource ) > $depth ) {
				return sizeof( $datasource );
			}
			
			return $depth;
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
		 * @abstract
		 */
		 
		abstract public function walk( QAcceptee_Interface $acceptee );
		
	}
	
?>