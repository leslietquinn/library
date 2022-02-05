<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Request_Uri_Route implements QHttp_Request_Uri_Route_Interface {
		const URL_VARIABLE = ':';
		const REGEX_DELIMITER = '#';
		const DEFAULT_REGEX = '[a-z0-9\-_]+';
		
		private $parts;
		private $defaults = array();
		private $required = array();
		
		public function __construct( $route, $defaults = array(), $required = array() ) {
			$route = trim( $route, '/' ); 
			$this -> defaults = array_merge( $this -> defaults, $defaults );
			$this -> required = array_merge( $this -> required, $required );
			
			foreach( explode( '/', $route ) as $position => $part ) { 
				if( self::URL_VARIABLE == $part[0] ) { 
					$name = substr( $part, 0 ); 
					$realname = substr( $name, 1 ); 
					$regex = isset( $required[$realname] )? $required[$realname]: self::DEFAULT_REGEX;
					$this -> parts[$position] = array( 'name' => $name, 'regex' => $regex );
				} else { 
					$this -> parts[$position] = array( 'regex' => preg_quote( $part, self::REGEX_DELIMITER ) );
				}
			} 
		}
		
		public function match( $path ) { 
			$values = $this -> defaults;
			$path = explode( '/', trim( $path, '/' ) ); 
			
			foreach( $this -> parts as $position => $part ) { 
				$name = isset( $part['name'] )? $part['name']:null; 
				$regex = self::REGEX_DELIMITER.'^'.$part['regex'].'$'.self::REGEX_DELIMITER.'i';
				
				$realname = substr( $name, 1 ); 
				if( !empty( $path[$position] ) && preg_match( $regex, $path[$position] ) ) {
					if( !is_null( $name ) ) { 
						$values[$realname] = $path[$position];
					}
				} else if( !is_null( $name ) && isset( $this -> defaults[$realname] ) ) { 
					continue;
				} else { 
					return false;
				}
			}
			return $values;
		}
	}
	
?>