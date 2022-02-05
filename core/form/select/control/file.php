<?php

	abstract class QForm_Select_Control extends QForm_Control {
		protected string $id;
		
		/**
		 * Class constructor
		 *
		 * @param	$id			string
		 *
		 * @access			public
		 * @introduced		2021/12/03 [last modified]
		 *
		 * @return			void
		 */
		 
		public function __construct( string $id = 'id' ) {
			$this -> id = $id;
		}
		
		/**
		 * Create array of options, with one pre selected if applicable
		 *
		 * @param	$selection			string	typically a PK
		 *								note, not the parameter name provided in form handler
		 *
		 * @access					public
		 * @return					array
		 */
		 
		protected function collect( $selection /* option selected */ ) : array { 
			if( $items = $this -> toArray() ) { 
				if( is_array( $items ) ) { 
					foreach( $items as $item ) { 
						
						/**
						 * @note	2021/12/03
						 *
						 *			typically the index to look for would be ID however not always, 
						 *			so a refactor has been made to allow for other than ID, for 
						 *			the appropriate option value to be selected
						 *
						 *			2021/12/06
						 *
						 *			refactored out: in_array( $item -> get( $this -> id ), (array) $selection )
						 */
						 
						if( $selection == $item -> get( $this -> id ) ) { 
							$item -> set( 'selected', 'selected="selected"' );
						} 
					}
				} 
				
				return $items;
			} 
			
			return array();
		}
		
		/**
		 * Prepare and return a data set suitable for a form control
		 *
		 * @access			public
		 * @abstract
		 *
		 * @return			array
		 */
		 
		abstract protected function toArray();
	}
	
?>