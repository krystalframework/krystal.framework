<?php/** * This file is part of the Krystal Framework *  * Copyright (c) 2015 David Yang <daworld.ny@gmail.com> *  * For the full copyright and license information, please view * the license file that was distributed with this source code. */namespace Krystal\Session\Adapter;use PDO;/** * The table should be already created. To create run MySQL.schema.sql */final class Sql implements SaveHandlerInterface{	/**	 * Prepared PDO instance	 * 	 * @var \PDO	 */	private $pdo;	/**	 * Dedicated table name	 * 	 * @var string	 */	private $table;	/**	 * State initialization	 * 	 * @param \PDO $pdo Prepared PDO instance	 * @param string $table Target table name	 * @return void	 */	public function __construct(PDO $pdo, $table)	{		$this->pdo = $pdo;		$this->table = $table;	}	/**	 * Opens a new session internally	 * 	 * @param string $path Session path	 * @param string $name	 * @return boolean	 */	public function open($path, $name)	{		return true;	}	/**	 * Closes the session internally	 * 	 * @return boolean	 */	public function close()	{		return true;	}	/**	 * Returns session data by its ID	 * 	 * @param string $id Session id	 * @return array|boolean	 */	private function fetchDataById($id)	{		$query = sprintf('SELECT `data` FROM `%s` WHERE `id` = :id', $this->table);		$stmt = $this->pdo->prepare($query);		$stmt->execute(array(			':id' => $id		));		$result = $stmt->fetch();		if (isset($result['data'])) {			return $result['data'];		} else {			return false;		}	}	/**	 * Inserts data by id	 * 	 * @param string $id Session id	 * @param string $data Session data	 * @return boolean	 */	private function insertDataById($id, $data)	{		$query = sprintf('INSERT INTO `%s` (`id`, `data`, `touched`) VALUES (:id, :data, :touched)', $this->table);		$stmt = $this->pdo->prepare($query);		return $stmt->execute(array(			':id'		=>	$id,			':data'		=>	$data,			':touched'	=>	time(),		));	}		/**	 * Updates session data by given id	 * 	 * @param string $id Session id	 * @param string $data Session data	 * @return boolean Depending on success	 */	private function updateDataById($id, $data)	{		$query = sprintf('UPDATE `%s` SET `data` = :data, `touched` = :touched WHERE `id` = :id LIMIT 1', $this->table);		$stmt  = $this->pdo->prepare($query);		return $stmt->execute(array(			':data'		=>	$data,			':touched'	=>	time(),			':id'		=>	$id,		));	}	/**	 * Writes data to the session	 * 	 * @param string $id Session id	 * @param array $data Session data	 * @return boolean	 */	public function write($id, $data)	{		if ($this->fetchDataById($id) !== false) {			$this->updateDataById($id, $data);		} else {			$this->insertDataById($id, $data);		}		return true;	}	/**	 * Reads data from the session	 * 	 * @param string $id Session id (used internally by PHP engine)	 * @throws \PDOException If an error occurred	 * @return string (Always! or PHP crashes)	 */	public function read($id)	{		$data = $this->fetchDataById($id);		if ($data !== false) {			return $data;		} else {			return '';		}	}	/**	 * Deletes data from the session	 * 	 * @param string $id Session id	 * @throws \PDOException If an error occurred	 * @return boolean true always	 */	public function destroy($id)	{		$query = sprintf('DELETE FROM `%s` WHERE `id` = :id', $this->table);		$stmt = $this->pdo->prepare($query);		$stmt->execute(array(			':id' => $id		));		return true;	}	/**	 * Garbage collection	 * 	 * @param integer $maxlifetime	 * @return boolean Depending on success	 */	public function gc($maxlifetime)	{		$query = sprintf('DELETE FROM `%s` WHERE touched + %s < %s', $this->table, $maxlifetime, time());		$this->pdo->exec($query);		return true;	}}