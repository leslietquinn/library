<?php

	/**
	 * @package		page
	 * @subpackage	dataspace
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 */
	 
	class QPage_Renderer extends QPage {
		
		/**
		 * Class constructor
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface 
		 *
		 * @access			public
		 * 
		 * @return			void
		 */
		 
		public function __construct( QDataspace_Interface $dataspace ) {
			parent::__construct( $dataspace );
		}
		
		/**
		 * Render a given template with data from observers
		 *
		 * @param	$template		string
		 *
		 * @access					public
		 * @return					void
		 */
		 
		public function render( string $template ) : void { 
			include_once( $this -> prepare( $template ) );
		}
	}
	
?>