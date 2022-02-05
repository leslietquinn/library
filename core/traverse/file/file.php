<?php

	final class QTraverse_File extends QTraverse {
		protected $fp = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$fp				resource
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			void
		 */
		 
		public function __construct( $fp ) {
			parent::__construct();
			
			$this -> fp = $fp;
		}
		
		/**
		 * Walk through a file structure, line by line, recursively
		 *
		 * @param	$acceptee			object typeof QAcceptee_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/14
		 *
		 * @return			void
		 */
		 
		public function walk( QAcceptee_Interface $acceptee ) {
			if( ( $line = fgets( $this -> fp ) ) !== false ) { 
				try {

					/**
					 * @note 	do something with this line of text
					 */

					$acceptee -> push( $line );
				} catch( QTraverse_Adapter_Exception $e ) {
					throw new QTraverse_Exception( $e -> getMessage() );
				}
				
				/**
				 * @note 	fetch the next line from file
				 */
				
				$walker = new QTraverse_File( $this -> fp );
				$walker -> walk( $acceptee );
			} 
		}
	}
	
?>