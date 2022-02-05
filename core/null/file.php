<?php

	final class QNull {
		
		/**
		 * Return true if null
		 *
		 * @param	$parameter			mixed
		 *
		 * @access				public
		 * @static
		 * 
		 * @return				bool
		 */
		 
		static public function is( $parameter ) : bool {
			if( is_null( $parameter ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Return true if not null
		 *
		 * @param	$parameter			mixed
		 *
		 * @access				public
		 * @static
		 * 
		 * @return				bool
		 */
		 
		static public function not( $parameter ) : bool {
			if( !( is_null( $parameter ) ) ) {
				return true;
			}
			
			return false;
		}
	}
	
?>