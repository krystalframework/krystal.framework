<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) 2015 David Yang <daworld.ny@gmail.com>
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Db\Sql;

use Krystal\Paginate\PaginatorInterface;

abstract class AbstractMapper
{
	/**
	 * Prepare paginator's instance
	 * 
	 * @var \Krystal\Paginate\PaginatorInterface
	 */
	protected $paginator;

	/**
	 * Database handler
	 * 
	 * @var \Krystal\Db\Sql\Db
	 */
	protected $db;

	/**
	 * State initialization
	 * 
	 * @param \Krystal\Db\Sql\Db
	 * @param \Krystal\Paginate\PaginatorInterface $paginator
	 * @return void
	 */
	public function __construct(Db $db, PaginatorInterface $paginator)
	{
		$this->db = $db;
		$this->setPaginator($paginator);
	}

	/**
	 * @TODO
	 */
	protected function manyToOne()
	{
	}
	
	/**
	 * @TODO
	 */
	protected function oneToOne()
	{
	}
	
	/**
	 * Fetches one column
	 * 
	 * @param string $table
	 * @param string $column
	 * @param string $key
	 * @param string $value
	 * @return array
	 */
	final protected function fetchOneColumn($table, $column, $key, $value)
	{
		return $this->db->select($column)
						->from($table)
						->whereEquals($key, $value)
						->query($column);
	}

	/**
	 * Fetches all row data by column's value
	 * 
	 * @param string $table
	 * @param string $column
	 * @param string $value
	 * @param mixed $select
	 * @return array
	 */
	final protected function fetchAllByColumn($table, $column, $value, $select = '*')
	{
		return $this->db->select($select)
						->from($table)
						->whereEquals($column, $value)
						->queryAll();
	}

	/**
	 * Fetches single row a column
	 * 
	 * @param string $table Table name
	 * @param string $column The name of PK column
	 * @param string $value The value of PK
	 * @param mixed $select Data to be selected. By default all columns are selected
	 * @return array
	 */
	final protected function fetchByColumn($table, $column, $value, $select = '*')
	{
		return $this->db->select($select)
						->from($table)
						->whereEquals($column, $value)
						->query();
	}

	/**
	 * Deletes a row by its associated PK
	 * 
	 * @param string $table
	 * @param string PK's column
	 * @param string PK's value
	 * @return boolean
	 */
	final protected function deleteByColumn($table, $column, $value)
	{
		return $this->db->delete()
						->from($table)
						->whereEquals($column, $value)
						->execute();
	}

	/**
	 * Returns last id
	 * 
	 * @return integer
	 */
	public function getLastId()
	{
		return $this->pdo->lastInsertId();
	}

	/**
	 * Sets paginator's instance
	 * 
	 * @param \Krystal\Paginate\PaginatorInterface $paginator
	 * @return $this
	 */
	public function setPaginator(PaginatorInterface $paginator)
	{
		$this->paginator = $paginator;
		return $this;
	}

	/**
	 * Return paginator's instance
	 * 
	 * @return object
	 */
	public function getPaginator()
	{
		return $this->paginator;
	}
}
