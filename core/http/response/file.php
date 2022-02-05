<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Response implements QHttp_Response_Interface {
		private $minify;
		
		/**
		 * Class constructor
		 *
		 * @param	$minify			bool
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function __construct( $minify = false ) {
			$this -> minify = $minify;
		}
		
		/**
		 * Output the rendered data, send as response
		 *
		 * @param	$handler			object typeof QPage_Handler_Interface
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function output( QPage_Handler_Interface $handler, QDataspace_Interface $dataspace ) {
			ob_start();
			$this -> traverse( $handler, $dataspace );
			echo( ob_get_clean() );
		}
		
		/**
		 * Move through the composite structure and render, cache the output
		 *
		 * @param	$handler			object typeof QPage_Handler_Interface
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			private
		 * @return			void
		 */
		 
		private function traverse( QPage_Handler_Interface $handler, QDataspace_Interface $dataspace ) {
			foreach( $handler -> getChildren() as $child ) {
				ob_start();
				$this -> traverse( $child, $dataspace );
				$dataspace -> set( $child -> getId(), $dump = ob_get_clean() );
			}
			
			/**
			 * @note	execute a (child) handler and cache the output, ready to 
			 *			be put into the appropriate template position
			 *
			 */
			 
			$handler -> execute( $dataspace );
		}
	}
	
?>