<?php

	abstract class QTemplate implements QTemplate_Interface {
		protected string $fragment;
		protected string $html;
		
		/**
		 * Class constructor
		 * 
		 * @param	$filename			string
		 * 
		 * @access			public
		 * @introduced		2022/01/16 [last modified]
		 * @return			void
		 */

		public function __construct( string $filename ) {
			$this -> fetch( $filename );
		}
		
		/**
		 * Set an HTML fragment, from a helper class
		 * 
		 * @param	$html 			string
		 * 
		 * @access			public
		 * @introduced		2022/01/16
		 * @return			void
		 */

		public function setHtml( string $html ) : void {
			$this -> html = $html;
		}

		/**
		 * Return a HTML fragment
		 * 
		 * @access			public
		 * @introduced		2022/01/16
		 * @return			string
		 */

		public function getHtml() : string {
			return $this -> html;
		}
		
		/**
		 * Return contents of a file 
		 * 
		 * @param 	$filename		string
		 * 
		 * @access			protected
		 * @introduced		2022/01/16 [last modified]
		 * @return			void
		 */

		protected function fetch( string $filename ) : void { 
			if( is_file( $filename ) && is_readable( $filename ) ) {
				$this -> fragment = file_get_contents( $filename );
			}
		}
		
		/**
		 * Parse one row of data with associated template fragment
		 *
		 * @see				QTemplate_Helper::massage();
		 *
		 * @access				public
		 * @return				string			parsed html fragment
		 * @abstract
		 */
		 
		abstract public function parse() : string;
	}
	
	// example of use
	/*
	class QUsers_Template extends QTemplate {
		public function __construct( $filename ) {
			parent::__construct( $filename );
		}

		public function parse() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$temp = str_replace( '<phptag:id />', $dataspace -> get( 'id' ), $this -> fragment );
			$temp = str_replace( '<phptag:firstname />', $dataspace -> get( 'firstname' ), $temp );
			$temp = str_replace( '<phptag:lastname />', $dataspace -> get( 'lastname' ), $temp );
			
			return $temp;
		}
	}
	*/
	
	// $template = new QUsers_Template( $request = QRegistry::get( 'request' ) );
	// $template -> set( 'users', $helper -> toHtml() );

?>