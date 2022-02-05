<?php

	final class QFilter_String_Encode_Utf8 implements QFilter_Interface {
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}

		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );

			$dataspace -> set( $this -> field_name, mb_convert_encoding(
				$dataspace -> get( $this -> field_name ), 'UTF-8', mb_detect_encoding(
					$dataspace -> get( $this -> field_name ), 'UTF-8, ISO-8859-1, ISO-8859-15', true )
				)
			);
		}
	}

?>