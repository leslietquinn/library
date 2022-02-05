<?php

	abstract class QForm_CheckBox_Control extends QForm_Control {
		const GENERIC_NAME = '__generic__';
		
		public function __construct() {}
		
		/**
		 * @param	$selection		array		array of options available
		 */
		 
		protected function collect( $selection ) { 
			if( $items = $this -> toArray() ) { 
				foreach( $items as $item ) { 
					if( in_array( $item -> get( 'id' ), (array) $selection ) ) { 
						$item -> set( 'checked', 'checked="checked"' ); 
					}
				}
				
				return $items;
			}
			
			return false;
		}
		
		/**
		 * Return an array encapsulated within typeof QDataspace_Interface 
		 *
		 * @see		./
		 */
		 
		abstract protected function toArray();
	}
	
?>