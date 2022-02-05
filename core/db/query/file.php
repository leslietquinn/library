<?php

	/**
	 * @package		db
	 * @subpackage 	query
	 * @version		beta-12s, 21-pending
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
	
	final class QDb_Query {
		private $abbrev_columns = array();
		private $conditions = array();
		private $columns = array();
		private $orderby = array();
		private $tables = array();
		private $groupby = null;
		private $limitby = null;
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Build the SQL to completeness
		 *
		 * @access			public
		 * @introduced		2021/11/21
		 *
		 * @return			string
		 */
		 
		public function build() : string {
			$sql = '';
			foreach( $this -> abbrev_columns as $column ) {
				$sql .= $column.', ';
			}
			
			$sql = rtrim( $sql, ', ' );
			$sql = 'SELECT '.$sql.' from ';
			
			foreach( $this-> tables as $k => $v ) {
				$sql .= $v.' '.$k.', ';
			}
			
			$sql = rtrim( $sql, ', ' ).' ';
			
			foreach( $this -> joins as $join ) {
				$sql .= $join['opener'].' '.$join['closer'].' ';
			}
			
			if( count( $this -> conditions ) ) {
				$sql .= ' WHERE ';
				
				foreach( $this -> conditions as $condition ) {
					$sql .= $condition.' ';
				}
				
				$sql = rtrim( $sql, ', ' );
			}
			
			if( $this -> groupby ) {
				$sql .= ' GROUP BY '.$this -> groupby;
			}
			
			if( count( $this -> orderby ) ) {
				$sql .= ' ORDER BY ';
				foreach( $this -> orderby as $ordering ) {
					$sql .= $ordering.', ';
				}
				
				$sql = rtrim( $sql, ', ' );
			}
			
			if( $this -> limitby ) {
				$sql .= ' LIMIT '.$this -> limitby;
			}
			
			return $sql;
		}
		
		/**
		 * Add a column to the SELECT
		 *
		 * @param	$column			string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function select( string $column ) : QDb_Query {
			$this -> columns[] = $column;
			
			return $this;
		}
		
		public function with() {
			
		}
		
		/**
		 * Add a FROM table to the SELECT
		 *
		 * @param	$abbrev			string
		 * @param	$table			string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function from( string $abbrev, string $table ) : QDb_Query {
			$this -> tables[$abbrev] = $table;
			
			foreach( $this -> columns as $column ) {
				$this -> abbrev_columns[] = $abbrev.'.'.$column;
			}
			
			$this -> columns = array();
			
			return $this;
		}
		
		/**
		 * Add a WHERE condition on the SELECT
		 *
		 * @param	$abbrev			string
		 * @param	$column			string
		 * @param	$compare_with	string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function where( string $abbrev, string $column, string $compare_with ) : QDb_Query {
			$this -> conditions[] = $abbrev.'.'.$column.' '.$compare_with.' ? ';
			
			return $this;
		}
		
		/**
		 * Add an AND to the WHERE condition
		 *
		 * @param	$abbrev			string
		 * @param	$column			string
		 * @param	$compare_with	string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function andCondition( string $abbrev, string $column, string $compare_with ) : QDb_Query {
			$this -> conditions[] = 'AND '.$abbrev.'.'.$column.' '.$compare_with.' ? ';
			
			return $this;
		}
		
		/**
		 * Add an OR to the WHERE condition
		 *
		 * @param	$abbrev			string
		 * @param	$column			string
		 * @param	$compare_with	string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function orCondition( string $abbrev, string $column, string $compare_with ) : QDb_Query {
			$this -> conditions[] = 'OR '.$abbrev.'.'.$column.' '.$compare_with.' ? ';
			
			return $this;
		}
		
		/**
		 * Add a LEFT JOIN on the SELECT
		 *
		 * @param	$abbrev			string
		 * @param	$column			string
		 * @param	$table			string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function leftJoin( string $abbrev, string $column, string $table ) : QDb_Query {
			$this -> joins[] = array(
				'opener'	=>	'LEFT JOIN '.$table.' '.$abbrev.' ON '.$abbrev.'.'.$column.' = ',
				'closer'	=>	null,
			);
			
			return $this;
		}
		
		/**
		 * Add a RIGHT JOIN on the SELECT
		 *
		 * @param	$abbrev			string
		 * @param	$column			string
		 * @param	$table			string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function rightJoin( string $abbrev, string $column, string $table ) : QDb_Query {
			$this -> joins[] = array(
				'opener'	=>	'RIGHT JOIN '.$table.' '.$abbrev.' ON '.$abbrev.'.'.$column.' = ',
				'closer'	=>	null,
			);
			
			return $this;
		}
		
		/**
		 * Add an INNER JOIN on the SELECT
		 *
		 * @param	$abbrev			string
		 * @param	$column			string
		 * @param	$table			string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function innerJoin( string $abbrev, string $column, string $table ) : QDb_Query {
			$this -> joins[] = array(
				'opener'	=>	'INNER JOIN '.$table.' '.$abbrev.' ON '.$abbrev.'.'.$column.' = ',
				'closer'	=>	null,
			);
			
			return $this;
		}
		
		/**
		 * Add an OUTER JOIN on the SELECT
		 *
		 * @param	$abbrev			string
		 * @param	$column			string
		 * @param	$table			string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function outerJoin( string $abbrev, string $column, string $table ) : QDb_Query {
			$this -> joins[] = array(
				'opener'	=>	'OUTER JOIN '.$table.' '.$abbrev.' ON '.$abbrev.'.'.$column.' = ',
				'closer'	=>	null,
			);
			
			return $this;
		}
		
		/**
		 * Add a closing column to the most recent JOIN on the SELECT
		 *
		 * @param	$abbrev			string
		 * @param	$column			string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function on( string $abbrev, string $column ) : QDb_Query {
			$position = count( $this -> joins );
			
			$join = array_pop( $this -> joins );
			$join['closer'] = $abbrev.'.'.$column;
			
			$this -> joins[$position] = $join;
			
			return $this;
		}
		
		/**
		 * Filter results using a GROUP BY on the SELECT
		 *
		 * @param	$abbrev			string
		 * @param	$column			string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function groupBy( string $abbrev, string $column ) : QDb_Query {
			$this -> groupby = $abbrev.'.'.$column;
			
			return $this;
		}
		
		/**
		 * Sort results using an ORDER BY on the SELECT
		 *
		 * @note	in the event the ordering can't be determined, allow for 
		 *			the ordering to be set dynamically
		 *
		 * @param	$abbrev			string
		 * @param	$column			string
		 * @param	$orderby		string
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function orderBy( string $abbrev, string $column, string $ordering ) : QDb_Query {
			$this -> orderby[] = $abbrev.'.'.$column.' '.$ordering;
			
			return $this;
		}
		
		/**
		 * Set a LIMIT on the SELECT
		 *
		 * @param	$offset			int
		 * @param	$count			int
		 *
		 * @access			public
		 * @introduced		2021/11/20
		 *
		 * @return			object typeof QDb_Query
		 */
		 
		public function limitBy( int $offset, int $count ) : QDb_Query {
			$this -> limitby = $offset.', '.$count;
			
			return $this;
		}
		
	}
	
	/* example of use *//*
			$query = new QDb_Query();
			
			$sql = $query
				-> select( 'id' )
				-> select( 'name' )
				-> select( 'parent' ) 
					-> from( 'ca', 'categories' )
					
				-> select( 'id' )
				-> select( 'price' )
				-> select( 'currency' )
					-> from( 'pr', 'products' )
					
				-> leftJoin( 'pr', 'category', 'products' ) 
					-> on( 'ca', 'id' )
					
				-> where( 'ca', 'name', QDb::EQUALS ) 
					-> andCondition( 'pr', 'currency', QDb::EQUALS )
				
				-> groupBy( 'pr', 'id' ) 
				-> orderBy( 'ca', 'name', $ordering )
				-> orderBy( 'pr', 'currency', QDb::toggle( $ordering ) )
				-> limitBy( 0, 24 )
				-> build();
	*/
	
?>