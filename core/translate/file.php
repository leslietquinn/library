<?php

	/**
	 * @package		translate
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	/**
	 * Copyright Notice
	 *
	 * Class and class functions [implementation] is the sole ownership and
	 * copyright owner of Leslie Quinn <les.quinn.2012@gmail.com>
	 *
	 * No part of this script, or associated script found within the framework
	 * may be used in any way, in whole or in part without prior written
	 * permission of Leslie Quinn
	 */
	
	final class QTranslate implements QTranslate_Interface {
		private QTranslate_Database_Interface $database;
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/11/09
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Grab (get) a word with its translation, from English
		 *
		 * @note	we base all translations on, using the English word, we are 
		 *			not translating one word (German) from another language, such 
		 *			as French
		 *
		 * @param	$english_word			string
		 * @param	$langauge 				string [A-Z]{2} ISO2 code
		 *
		 * @access			public
		 * @introduced		2021/11/09
		 *
		 * @return			string
		 */
		 
		public function grab( string $english_word, string $language ) : string {
			return $this -> getDatabase() -> grab( strtolower( $english_word ), strtoupper( $language ) );
		}
		
		/**
		 * Put (set) a translation to a matched English word
		 *
		 * @todo	clean up the $translation to ensure it comforms to 
		 *			a proper unicode character
		 *
		 * @param	$english_word			string
		 * @param	$translation			string unicode
		 * @param	$language				string [A-Z]{2} ISO2 code
		 *
		 * @access			public
		 * @introduced		2021/11/09
		 *
		 * @return			bool
		 */
		 
		public function put( string $english_word, string $translation, string $language ) : bool {
			if( $this -> getDatabase() -> put( strtolower( $english_word ), $translation, strtoupper( $language ) ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Set a database, from external
		 *
		 * @param	$database			object typeof QTranslate_Database_Interface 
		 *
		 * @access			public
		 * @introduced		2011/11/09
		 *
		 * @return			void
		 */
		 
		public function setDatabase( QTranslate_Database_Interface $database ) {
			$this -> database = $database;
		}
		
		/**
		 * Facilitate access to a database
		 *
		 * @access			private
		 * @introduced		2011/11/09
		 *
		 * @return			object typeof QTranslate_Database_Interface
		 */
		 
		private function getDatabase() : QTranslate_Database_Interface {
			if( QNull::is( $this -> database ) ) {
				throw new QTranslate_Exception( 'thrown exception: unknown database [core/translate] 105' );
			}
			
			return $this -> database;
		}
	}
	
?>