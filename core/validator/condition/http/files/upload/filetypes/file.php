<?php

	final class QValidator_Condition_Http_Files_Upload_Filetypes extends QValidator_Condition {
		private $field_name;
		private $filetypes;
		private $message;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name		string
		 * @param	$filetypes		array
		 * @param	$message		string
		 *
		 * @see		./qvalidator/condition/http/files/types/
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function __construct( $field_name, $filetypes, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> filetypes = $filetypes;
			$this -> message = $message;
		}
		
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			$extension = QCommon::fileExtension( $dataspace -> get( $this -> field_name ) -> get( 'name' ) );
			
			if( !in_array( $extension, $this -> filetypes ) ) {
				$logger -> set( $this -> field_name, $this -> message );
				return false;
			}
			
			return true;
		}
	}
	
?>