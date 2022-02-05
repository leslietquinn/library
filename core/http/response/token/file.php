<?php

	final class QHttp_Response_Token implements QHttp_Response_Interface {
		private array $templates;
		private bool $minify;
		
		/**
		 * Class constructor
		 *
		 * @param	$token			string		the root token or composite ID
		 * @param	$minify			bool		strip whitespace, tabs and newlines or not
		 *
		 * @access					public
		 * @return					void
		 */
		 
		public function __construct( string $token = 'page', bool $minify = false ) {
			$this -> templates = array();
			$this -> minify = $minify;
			$this -> token = $token;
		}
		
		public function output( QPage_Handler_Interface $handler, QDataspace_Interface $dataspace ) {
			$this -> templates[$handler -> getId()] = $handler -> execute( $dataspace );
			
			foreach( $handler -> getChildren() as $child ) { 
				// sanity check added 09/04/2020
				if( $child instanceof QPage_Handler_Interface ) {
					$this -> output( $child, $dataspace );
				}
				
				$this -> templates[$handler -> getId()] = str_replace(
					'<phptag:'.$child -> getId().' />',
					$this -> templates[$child -> getId()],
					$this -> templates[$handler -> getId()] ); 
			}
		}
		
		public function render() {  
			if( array_key_exists( $this -> token, $this -> templates ) ) { 
				if( $this -> minify ) {
					echo preg_replace( '/(\s\s+|\t|\n)/', ' ', $this -> templates[$this -> token] );
				} else {
					echo $this -> templates[$this -> token];
				}
			}
		}
	}
	
?>