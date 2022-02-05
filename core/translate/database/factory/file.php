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
	
	final class QTranslate_Database_Factory implements QTranslate_Database_Factory_Interface {
		private string $language;
		
		/**
		 * Class constructor
		 *
		 * @param	$language 			string [A-Z]{2} ISO2 code
		 *
		 * @access			public
		 * @introduced		2021/11/09
		 *
		 * @return			void
		 */
		 
		public function __construct( string $language ) {
			$this -> language = $language;
		}
		
		/**
		 * Facilitate access to the database, a file system
		 *
		 * @access			public
		 * @introduced		2021/11/09
		 *
		 * @see				QFile::__construct();
		 * @return			string
		 * @throws			QTranslate_Database_Exception
		 */
		 
		public function getFilesystem() : string {
			$directory = dirname( dirname( __FILE__ ) ).'/cache/'.$this -> language.'/'; 
			
			/**
			 * @note	ensure the file directory exists or create it if 
			 *			need be
			 *
			 */
			 
			$file = new QFile( $directory );
			if( !$file -> isDirectory() ) {
				if( !$file -> createDirectory() ) {
					throw new QTranslate_Database_Exception( 'thrown exception: unable to create directory [core/translate/database/factory] 62' );
				}
			}
			
			/** 
			 * @note	ensure the file exists, or create a new one
			 *
			 */
			 
			$file = new QFile( $directory.'cache.dat' );
			if( !$file -> isFile() ) {
				if( !$file -> write( null ) ) {
					throw new QTranslate_Database_Exception( 'thrown exception: unable to create file [core/translate/database/factory] 74' );
				}
			}
			
			return $file -> getFile();
		}		
	}
	
?>