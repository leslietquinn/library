<?php

	/**
	 * @package		filter
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QFilter_Http_Request_Utility_I18n implements QFilter_Interface {
		private $field_name;
		
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			// @note	split en_GB into en and GB separately
			$dataspace -> addFilter( new QFilter_String_Split( $this -> field_name, array( QCommon::LOCALE_LANGUAGE_TOKEN, QCommon::LOCALE_COUNTRY_TOKEN ), '_' ) );
			$dataspace -> process();
			
			
		}
	}
	
?>