<?php

	final class QCache {
		const MINUTE = 60;
		const HOURLY = 3600;
		const DAILY = 86400;
		const WEEKLY = 604800;
		const MONTHLY = 2419200;
		const YEARLY_QUARTER = 7257600;
		const YEARLY = 29030400;
		const NO_CACHE = 0; 
		
		/**
		 * Return a directory path to where cache files are stored
		 *
		 * @static
		 * @access					public
		 * @return					string		directory path
		 */
		 
		static public function directory() {
			return QRegistry::get( 'cache_directory' );
		}
	}
	
?>