<?php

	final class QValidator_Condition_Size_Between extends QValidator_Condition {
		protected $field_name;
		protected $message;
		protected $least;
		protected $most;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 * @param	$least				int
		 * @param	$most				int
		 * @param	$message			string
		 *
		 * @access			public
		 * @introduced		2021/12/18
		 *
		 * @return			void
		 */
		 
		public function __construct( string $field_name, int $least, int $most, string $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> message = $message;
			$this -> least = $least;
			$this -> most = $most;
		}
		
		/**
		 * A specified field length must match length exactly
		 *
		 * @param	$dataspace		object
		 * @param	$logger			object
		 *
		 * @access			public
		 * @return			bool
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) : bool {
			$value = $dataspace -> get( $this -> field_name );
			
			if( !( $value < $this -> most and $value >= $this -> least ) ) {
				$logger -> set( $this -> field_name, $this -> message );
				return false;
			} 
			
			return true;
		}
	}
	
?>