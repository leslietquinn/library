<?php

	final class QMaths {
		const EQUAL = '=';
		const NOT_EQUAL = '<>';
		const MORE_THAN = '>';
		const MORE_THAN_EQUAL = '=>';
		const LESS_THAN = '<';
		const LESS_THAN_EQUAL = '<=';
		const MULTIPLE = '*';
		const DIVIDE = '/';
		const MOD = '%';
		
		public function __construct() {}
		
		static public function isNegative( $number ) : bool { 
			if( ( filter_var( $number, FILTER_VALIDATE_FLOAT ) && $number > 0 ) ) {
				return false;
			}
			
			return true;
		}
		
		/**
		 * Return an integer if negative back as positive
		 *
		 * @param	$number		integer
		 *
		 * @access	public
		 * @return	int
		 */
		 
		static public function isPositive( $number ) : int {
			return abs( $number );
		}
		
		/**
		 * Return boolean if both float values are equal
		 *
		 * @param	$source 		float
		 * @param	$target			float
		 *
		 * @access	public
		 * @return				bool
		 */
		 
		static public function equalTo( $source, $target ) : bool {
			if( bccomp( (float) $source, (float) $target, 2 ) == 0 ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Return boolean if $source float is greater than $target float
		 *
		 * @param	$source 		float
		 * @param	$target			float
		 *
		 * @see		https://shanerutter.co.uk/php-compare-floats-why-its-different-to-a-normal-comparison/
		 *
		 * @access	public
		 * @return				bool
		 */
		 
		static public function greaterThan( $source, $target ) : bool {
			if( bccomp( (float) $source, (float) $target, 2 ) == 1 ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Return boolean if $source float is less than $target float
		 *
		 * @param	$source 		float
		 * @param	$target			float
		 *
		 * @see		https://www.geeksforgeeks.org/php-bccomp-function/
		 * @see		https://shanerutter.co.uk/php-compare-floats-why-its-different-to-a-normal-comparison/
		 *
		 * @access	public
		 * @return				bool
		 */
		 
		static public function lessThan( $source, $target ) : bool {
			if( bccomp( (float) $source, (float) $target, 2 ) == -1 ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Return a result of division as a fraction
		 *
		 * @note	example, 6 out of 8 would return 0.75, 1 out of 8 would return 0.125
		 *
		 * @param	$source
		 * @param	$target
		 *
		 * @access	public
		 * @return	int
		 */
		 
		static public function division( $source, $target ) : int { 
			if( $target > 0 ) {
				return round( $source / $target, 2 );
			}
			
			return 0;
		}
		
		/**
		 * Return a result of multiplication
		 *
		 * @note	example, 0.125 * 100 = 12.5
		 *
		 * @param	$number
		 * @param	$multiply_with
		 *
		 * @access	public
		 * @return	int
		 */
		 
		static public function multiply( $number, $multiply_with ) : int { 
			return round( $number * $multiply_with, 2 );
		}
		
		/**
		 * Return a difference between two float numbers
		 *
		 * @param	$source			float
		 * @param	$target			float
		 * @param	$decimal_places	integer
		 *
		 * @access	public
		 * @return	float
		 */
		 
		static public function differenceBetween( float $source, float $target, $decimal_places = 2 ) : float {
			return (float) round( $source - $target, $decimal_places );
		}
		
		/**
		 * Calculate the value minus a percentage taken off
		 *
		 * @param	$value			float
		 * @param	$percentage		float
		 * @param	$decimal_places	integer
		 *
		 * @access	public
		 * @return	float
		 */
		 
		static public function percentageFrom( float $value, float $percentage, $decimal_places = 2 ) : float {
			return (float) round( $value - ( ( $percentage / 100 ) * $value ), $decimal_places );
		}
		
		/**
		 * Return value given percentage against two values, $source being the lowest
		 *
		 * @param	$source			float
		 * @param	$target			float
		 *
		 * @access	public
		 * @return	float
		 */
		 
		static public function percentageOfDifference( $source, $target ) : float { 
			if( ( filter_var( $source, FILTER_VALIDATE_FLOAT ) && filter_var( $target, FILTER_VALIDATE_FLOAT ) ) )  {
				return round( abs( ( 1 - ( $source / $target ) ) * 100 ), 2 ); 
			}
			
			return 00.00;
		}
		
		/**
		 * Return boolean if two numbers divisable by zero or not
		 *
		 * @param	$source			mixed
		 * @param	$target			mixed
		 *
		 * @access	public
		 * @return	bool
		 */
		 
		static public function divisibleByZero( $source, $target ) : bool {
			return @( $source / $target ) === false;
		}
	}
	
?>