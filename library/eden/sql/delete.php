<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2009-2011 Christian Blanquera <cblanquera@gmail.com>
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

/**
 * Generates delete query string syntax
 *
 * @package    Eden
 * @category   sql
 * @author     Christian Blanquera <cblanquera@gmail.com>
 * @version    $Id: delete.php 1 2010-01-02 23:06:36Z blanquera $
 */
class Eden_Sql_Delete extends Eden_Sql_Query {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_table = NULL;
	protected $_where = array();
	
	/* Private Properties
	-------------------------------*/
	/* Get
	-------------------------------*/
	public static function i() {
		return self::_getMultiple(__CLASS__);
	}
	
	/* Magic
	-------------------------------*/
	public function __construct($table = NULL) {
		if(is_string($table)) {
			$this->setTable($table);
		}
	}
	
	/* Public Methods
	-------------------------------*/
	/**
	 * Set the table name in which you want to delete from
	 *
	 * @param string name
	 * @return this
	 */
	public function setTable($table) {
		//Argument 1 must be a string
		Eden_Sql_Error::i()->argument(1, 'string');
		
		$this->_table = $table;
		return $this;
	}
	
	/**
	 * Where clause
	 *
	 * @param array|string where
	 * @return	this
	 * @notes loads a where phrase into registry
	 */
	public function where($where) {
		//Argument 1 must be a string or array
		Eden_Sql_Error::i()->argument(1, 'string', 'array');
		
		if(is_string($where)) {
			$where = array($where);
		}
		
		$this->_where = array_merge($this->_where, $where); 
		
		return $this;
	}
	
	/**
	 * Returns the string version of the query 
	 *
	 * @return string
	 * @notes returns the query based on the registry
	 */
	public function getQuery() {
		return 'DELETE FROM '. $this->_table . ' WHERE '. implode(' AND ', $this->_where).';';
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}