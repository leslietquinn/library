<?php

	abstract class QTemplate_Helper {
		protected QTemplate_Interface $template;
		
		/**
		 * Class constructor
		 * 
		 * @access			public
		 * @introduced		2022/01/16 [last modified]
		 * @return			void
		 */

		public function __construct() {}
		
		/**
		 * Return a HTML fragrment, previously built up
		 * 
		 * @access			public
		 * @introduced		2022/01/16
		 * @return			string
		 */

		public function toHtml() : string {
			return $this -> template -> getHtml();
		}
		
		/**
		 * Facilitate the parsing of each row of data with associated html template fragment
		 *
		 * @param	$rs			array			array of QDataspace_Interface 
		 *
		 * @access				public
		 * @return				void
		 * @abstract
		 */
		 
		abstract public function massage( array $array ) : void;
	}
	
	// example of use
	/*
	final class QUsers_Helper extends QTemplate_Helper {
		public function __construct( $filename ) {
			$this -> template = new QTemplate( $filename );
		}
		
		public function massage( QDataspace_Interface $dataspace ) {
			$html = '';
			foreach( $dataspace as $row ) {
				$html .= $this -> template -> parse( $row );
			}
			$this -> template -> setHtml( $html );
		}
	}
	*/
	// $helper = new QUsers_Helper( 'users.template.tpl' );
	// $helper -> massage( $rs );

?>