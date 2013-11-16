<?php

namespace Main;

use \Nette\Object;

/**
 * Operácie nad db tabuľkou
 * všetky ostatné repositories budú rozširovať tento a tým pádom získajú tieto metódy aj pripojenie k db
 */
class Repository extends \Nette\Object {
	
	/** @var Nette\Database\Connection */
	protected $database;

	/**
	 * Potrebné pripojenie k db
	 * @return \Nette\Database\Connection
	 */
	public function __construct(\Nette\Database\Connection $database) {
		$this->database = $database;
	}


	/**
	 * Vráti objekt reprezentujúci db tabuľku
	 * @return Nette\Database\Table\Selection
	 */
	protected function getTable() {
		// názov tabuľky sa odvodí z názvu triedy
		preg_match('#(\w+)Repository$#', get_class($this), $m);
		return $this->database->table(lcfirst($m[1]));
	}

	/**
	 * Vráti všetky riadky z tabuľky
	 * @return Nette\Database\Table\Selection
	 */
	public function findAll() {
		return $this->getTable();
	}

	/**
	 * Vráti riadky podľa filtra, napr. array('name' => 'John').
	 * @param array $by
	 * @return Nette\Database\Table\Selection
	 */
	public function findBy(array $by) {
		return $this->getTable()->where($by);
	}

	/**
	 * Nájde podľa id
	 * @param int $id
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findById($id) {
		return $this->findBy(array('id' => $id))->fetch();
	}

	/**
	 * Vracia riadok podľa primárneho kľúča
	 * @param int $id
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function find($id) {
		return $this->getTable()->get($id);
	}

}