<?php

	interface QTemplate_Interface {

		/**
		 * Set an HTML fragment
		 * 
		 * @param	$html 			string
		 * 
		 * @access			public
		 * @introduced		2022/01/16 [last modified]
		 * @return			void
		 */

		public function setHtml( string $html );

		/**
		 * Return a HTML fragment
		 * 
		 * @access			public
		 * @introduced		2022/01/16
		 * @return			string
		 */

		public function getHtml();
	}
	
?>