<?php

	final class QStack implements QSerialisable_Interface {
		private $queue = array();

		public function __construct() {}

		/**
		 * Determine if array values are all the same, unique
		 *
		 * @param	$array			array, non associative
		 *
		 * @access			public
		 * @introduced		2021/10/24
		 *
		 * @return			bool
		 */
		 
		public function unique( array $array ) : bool {
			if( count( array_unique( $array ) ) === 1 ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Put (cache) an array structure
		 *
		 * @param	$array		array
		 * @param	$filename	string
		 *
		 * @access			public
		 * @return 			bool
		 */
		
		public function put( array $array, string $filename ) : bool { 
			$file = new QFile( $filename );
			if( is_array( $array ) && count( $array ) > 0 ) {
				file_put_contents( $file -> getFile(), serialize( $array ) );
				
				return true;
			}
			
			return false;
		}
		
		/**
		 * Grab (uncache) an array structure
		 *
		 * @param	$filename	string
		 *
		 * @access			public
		 * @return 			array
		 */
		
		public function grab( string $filename ) : array {
			$file = new QFile( $filename );
			if( $file -> isFile() ) {
				$array =  unserialize( file_get_contents( $file -> getFile() ) );
				
				/**
				 * @note	in the event there is no array, return an empty 
				 *			array instead
				 *
				 */
				 
				if( !is_array( $array ) ) {
					return array();
				}
				
				return $array;
			} 
			
			return array();
		}
		
		/**
		 * Return the keys of an array only, no values
		 *
		 * @param	$array		array
		 *
		 * @access			public
		 * @return 			array
		 */
		
		public function keys( $array ) {
			return array_keys( $array );
		}
		
		/**
		 * Return the values of an array only, no keys
		 *
		 * @param	$array		array
		 *
		 * @access			public
		 * @return 			array
		 */
		
		public function values( $array ) {
			return array_values( $array );
		}
		
		/**
		 * Push something onto the stack
		 *
		 * @param	$element		mixed
		 * @param	$use_key		mixed	
		 *
		 * @access			public
		 * @return 			mixed
		 */
		
		public function push( $element, $use_key ) {
			if( isset( $use_key ) ) {
				$this -> queue[$key] = $element;
			} else {
				$this -> queue[] = $element;
			}
		}
		
		/**
		 * Pop something off the stack
		 *
		 * @param	$use_key		mixed	
		 *
		 * @access			public
		 * @return 			mixed
		 */
		
		public function pop( $use_key ) {
			if( isset( $use_key ) ) {
				if( array_key_exists( $use_key, $this -> queue ) ) {
					return $this -> queue[$use_key];
				}
			} else {
				return array_pop( $this -> queue );
			}
		}
		
		/**
		 * Replicate LIFO function; last in then first out, by removing from end of array
		 *
		 * @param	$array		array
		 *
		 * @access			public
		 * @return 			mixed
		 */
		
		public function lifo( $array ) {
			return array_pop( $array );
		}
		
		public function filo( $array ) {}
		
		/**
		 * Replicate FIFO function; first in then first out, by removing from beginning of array
		 *
		 * @param	$array		array
		 *
		 * @access			public
		 * @return 			mixed
		 */
		
		public function fifo( $array ) {
			return array_shift( $array );
		}
		
		/**
		 * Flip around the key and value pair
		 *
		 * @param	$array		array
		 *
		 * @access			public
		 * @return 			array
		 */
		
		public function flip( $array ) {
			if( is_array( $array ) ) {
				return array_flip( $array );
			}
			
			return array();
		}
		
		/**
		 * Merge an array with current stack
		 *
		 * @param	$array		array
		 *
		 * @access			public
		 * @return 			void
		 */
		
		public function merge( $array ) {
			if( is_array( $array ) ) {
				$this -> queue = array_merge( $this -> queue, $array );
			}
		}

		/**
		 * Import a queue from a Dataspace object
		 *
		 * @param	$dataspace			object
		 * @param	$with_merge			boolean
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function import( QDataspace_Interface $dataspace, $with_merge = false ) {
			if( $with_merge ) {
				$this -> merge( $dataspace -> export() );
			} else {
				$this -> queue = $dataspace -> export();
			}
		}
		
		/**
		 * Export stack
		 *
		 * @param	$as_dataspace		boolean
		 *
		 * @access			public
		 * @return 			void
		 */
		
		public function export( $as_dataspace = false ) {
			if( $as_dataspace ) {
				return new QParameters( $this -> queue );
			} else {
				return $this -> queue;
			}
		}

		/**
		 * Determine if an array is numeric or associative
		 *
		 * @param	$array			array
		 *
		 * @access 		public
		 * @return		boolean
		 */
		 
		public function isAssociative( $array ) {
			if( array() === $array ) {
				return false;
			}
			
			return array_keys( $array ) !== range( 0, count( $array ) - 1 );
		}
		
		/**
		 * @note	https://stackoverflow.com/questions/3797239/insert-new-item-in-array-on-any-position-in-php
		 */
		 
		function insertBefore( $array, $index, $parameter ) {
			if( !array_key_exists( $index, $array ) ) {
				return array();
			}
			
			$original_index = 0;
			$tmp_array = array();
			
			foreach( $array as $k => $v ) {
				if( $k === $index ) {
					$tmp_array[] = $v;
					break;
				}
				
				$tmp_array[$k] = $parameer;
				$original_index++;
			}
			
			array_splice( $array, 0, $original_index, $tmp_array );
			
			return $array;
		}

		function insertAfter( $array, $index, $parameter ) {
			if( !array_key_exists( $index, $array ) ) {
				return array();
			}
			
			$original_index = 0;
			$tmp_array = array();
			
			foreach( $array as $k => $v ) {
				$tmp_array[$k] = $v;
				$original_index++;
				
				if( $k === $index ) {
					$tmp_array[] = $parameter;
					break;
				}
			}
			
			array_splice( $array, 0, $original_index, $tmp_array );
			
			return $array;
		}

	}
	
?>