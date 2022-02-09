<?php
	
	/**
	 * Replaces default form handler
	 * Takes into consideration the child <> parent relationship
	 */
	 
	abstract class QForm_Select_Control_Adapter extends QForm_Control {
		public function __construct() {}
		protected function collect( $selection ) : array { 
			if( $items = $this -> toArray() ) { 
				foreach( $items as $item ) { 
					if( $item -> has( 'children' ) ) { 
						// only consider child notes as parent is disabled
						foreach( $item -> get( 'children' ) as $child ) {
							
							/* in_array( $child -> get( 'id' ), (array) $selection ) */
							
							if( $selection == $item -> get( $this -> id ) ) {
								$child -> set( 'selected', 'selected="selected"' );
							}
						}
					}
				}
				
				return $items;
			}
			return array();
		}
		
		abstract protected function toArray();
	}
	
?>