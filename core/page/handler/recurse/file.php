<?php

	/**
	 * @package		page handler
	 * @version		beta-05f, 06;09-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QPage_Handler_Recurse {
		private $composite = null;
		
		public function __construct( QComposite_Interface $composite ) {
			$this -> composite = $composite;
		}
		
		public function attach( QComposite_Interface $handler, $parent ) {
			if( $this -> composite -> getId() == $parent ) {
				$this -> composite -> attach( $handler );
				return;
			}
			
			foreach( $this -> composite -> getChildren() as $child ) {
				$c = new QPage_Handler_Recurse( $child );
				$c -> attach( $handler, $parent );
			}
		}
		
		public function get() {
			return $this -> composite;
		}
	}
	
	/**
	 * example of use with AJAX handler; no factory creation
	 *
	 * 
	 * $handler = new QPage_Handler_Recurse( new QPage_Handler_Cachable( new QPage_Handler_Page() ) );
	 *		
	 * $handler -> attach( new QPage_Handler_Cachable( new QPage_Handler_Checkbox() ), 'page' );
	 *
	 * return $handler -> get();
	 *
	 */
	 
?>