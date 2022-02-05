<?php

	abstract class QForm_Control implements QAcceptee_Interface {
		protected $field_name;
		
		/**
		 * Class constructor
		 *
		 * @access		public
		 *
		 * @return		void
		 */
		 
		public function __construct() {}
		
		/**
		 * Push an operation onto another object, separate responsibility
		 *
		 * @param	$acceptable		object, expecting typeof QDataspace_Interface
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function push( $acceptable ) : void { 
			if( $collection = $this -> collect( $acceptable -> get( $this -> field_name ) ) ) {
				$acceptable -> import( new QParameters( array( $this -> field_name => $collection ) ) );
			} 
		}
		
		abstract protected function collect( $selection );
	}
	
?>