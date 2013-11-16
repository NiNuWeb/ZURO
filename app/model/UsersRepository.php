<?php

namespace Main;

use Nette\Security,
	Nette\Utils\Strings,
	Acl\Security\Authenticator;

class UsersRepository extends Repository {
	

	/**
	 * Nájde usera podľa username
	 * @param string $username
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findByName($username) {
		return $this->findAll()->where('username', $username)->fetch();
	}

	/**
	 * Registrácia nového používateľa
	 * @param array $data
	 * @return Nette\Database\Table\Selection
	 */
	public function register($data) {
		unset($data['password2']);
		$data['role'] = "guest";
		$data['password'] = Authenticator::calculateHash($data['password']);
		return $this->getTable()->insert($data);
	}

	/**
	 * Pridanie nového používateľa
	 * @param array $data
	 * @return Nette\Database\Table\Selection
	 */
	public function addUser($data) {
		$data['password'] = Authenticator::calculateHash($data['password']);
		return $this->getTable()->insert($data);
	}

	/**
	 * Editovanie používateľa
	 * @param int $id
	 * @param array $data
	 * @return Nette\Database\Table\Selection
	 */
	public function editUser($id, $data) {
		if(isset($data['password'])) {
			$data['password'] = Authenticator::calculateHash($data['password']);
		}
		return $this->getTable()->where('id = ?', $id)->update($data);
	}

	/**
	 * Signál na vymazanie usera
	 * @param int $id
	 * @return Nette\Database\Table\Selection
	 */
	public function deleteUser($id) {
		return $this->getTable()->where('id = ?', $id)->delete();
	}

	/**
	 * Vráti všetkých userov z tabuľky okrem ich hesiel
	 * @return Nette\Database\Table\Selection
	 */
	public function findAllUsers() {
		return $this->getTable()->select('id, username, first_name, last_name, email, active, role, profile');
	}

	/**
	 * Vráti usera z tabuľky podľa id
	 * @param int $id
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findById($id) {
		return $this->findBy(array('id' => $id))->fetch();
	}

}