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
	
	final class QTranslate_Database implements QTranslate_Database_Interface {
		private array $factories;
		
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
		 * @param	$english_word			string
		 * @param	$langauge 				string [A-Z]{2} ISO2 code
		 *
		 * @access			public
		 * @introduced		2021/11/09
		 *
		 * @see				QStack::grab();
		 * @see				QTranslate::grab();
		 * @return			string
		 * @throws			QTranslate_Exception
		 */
		 
		public function grab( string $english_word, string $language ) : string {
			try {
				$stack = new QStack();
				$database = $stack -> grab( $this -> getFactory( $language ) -> getFilesystem() );
				
				if( !is_array( $database ) ) {
					$database = array();
				}
				
				if( array_key_exists( $english_word, $database ) ) {
					return $database[$english_word];
				}
				
				return '';
			} catch( QTranslate_Database_Exception $e ) {
				throw new QTranslate_Exception( $e -> getMessage() );
			}
		}
		
		/**
		 * Put (set) a translation to a matched English word
		 *
		 * @param	$english_word			string
		 * @param	$translation			string unicode
		 * @param	$language				string [A-Z]{2} ISO2 code
		 *
		 * @access			public
		 * @introduced		2021/11/09
		 *
		 * @see				QStack::put();
		 * @see				QTranslate::put();
		 * @return			bool
		 * @throws			QTranslate_Exception
		 */
		 
		public function put( string $english_word, string $translation, string $language ) : bool {
			try {
				$stack = new QStack();
				
				/**
				 * @note	first, grab the existing array or otherwise use 
				 *			an empty array, whatever is returned
				 *
				 */
				 
				$database = $stack -> grab( $this -> getFactory( $language ) -> getFilesystem() );
				
				if( !is_array( $database ) ) {
					
					/**
					 * @note	just in case, a sanity check
					 *
					 */
					 
					$database = array();
				}
				
				$database[$english_word] = $translation;
				
				if( $stack -> put( $database, $this -> getFactory( $language ) -> getFilesystem() ) ) {
					return true;
				}
				
				return false;				
			} catch( QTranslate_Database_Exception $e ) {
				throw new QTranslate_Exception( $e -> getMessage() );
			}
		}
		
		/**
		 * Facilitate the means to set a factory, externally
		 *
		 * @param	$factory		object typeof QTranslate_Database_Factory_Interface
		 * @param	$language		string [A-Z]{2} ISO2 code
		 *
		 * @access			public
		 * @introduced		2021/11/09
		 *
		 * @see				QTranslate::getDatabase();
		 * @return			void
		 */
		 
		public function setFactory( QTranslate_Database_Factory_Interface $factory, string $language ) {
			$this -> factories[strtoupper( $language )] = $factory;
		}
		
		/**
		 * Facilitate access to storage area, through a factory
		 *
		 * @param	$language 			string
		 *
		 * @access			private
		 * @introduced		2021/11/09
		 *
		 * @return			object typeof QTranslate_Database_Factory_Interface
		 */
		 
		private function getFactory( string $language ) : QTranslate_Database_Factory_Interface {
			if( !array_key_exists( $language, $this -> factories ) ) { 
				$this -> factories[$language] = new QTranslate_Database_Factory( $language );
			}
			
			return $this -> factories[$language];
		}
	}
	
?>