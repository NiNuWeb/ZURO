<?php

namespace Main;


class NewsRepository extends Repository {

	/**
	 * Vybratie všetkých noviniek
	 * @return Nette\Database\Table\Selection
	 */
	public function getAllNews() {
		return $this->getTable()->order('date DESC');
	}

	/**
	 * Vybratie posledných X noviniek
	 * @param int $limit
	 * @return Nette\Database\Table\Selection
	 */
	public function getXnews($limit) {
		return $this->getTable()->order('date DESC')->limit($limit);
	}

	/**
	 * Pridanie novinky
	 * @param array $data
	 * @param int $user
	 * @return Nette\Database\Table\Selection
	 */
	public function addNews($data, $user) {
		$data['date'] = new \DateTime();
		$data['users_id'] = $user;
		return $this->getTable()->insert($data);
	}

	/**
	 * Vymaže novinku z DB
	 * @param int $id
	 * @return Nette\Database\Table\Selection
	 */
	public function deleteNews($id) {
		return $this->getTable()->where('id = ?', $id)->delete();
	}

	/**
	 * Edituje novinky z formulára
	 * @param int $id
	 * @param array $data
	 * @return Nette\Database\Table\Selection
	 */
	public function editNews($id, $data) {
		return $this->getTable()->where('id = ?', $id)->update($data);
	}

}