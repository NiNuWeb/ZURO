<?php

namespace ToDo;


class TaskRepository extends \Main\Repository {

	/**
	 * Vráti zoznam nedokončených úloh
	 * @return Nette\Database\Table\Selection
	 */
	public function findIncomplete() {
		return $this->findBy(array('done' => false))->order('created ASC');
	}

	/**
	 * Vráti zoznam nedokončených úloh konkrétneho používateľa
	 * @param int $userId
	 * @return Nette\Database\Table\Selection
	 */
	public function findIncompleteByUser($userId) {
		return $this->findIncomplete()->where(array('users_id' => $userId));
	}

	/**
	 * Vloží do DB úlohu
	 * @param int $listId
	 * @param string $task
	 * @param int $assignedUser
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function createTask($listId, $task, $assignedUser) {
		return $this->getTable()->insert(array(
			'text' 		=> $task,
			'users_id' 	=> $assignedUser,
			'created' 	=> new \DateTime(),
			'list_id' 	=> $listId
		));
	}

	/**
	 * Edituje úlohu
	 * @param int $id
	 * @param array $data
	 * @return Nette\Database\Table\Selection
	 */
	public function editTask($id, $data) {
		return $this->getTable()->where('id = ?', $id)->update($data);
	}

	/**
	 * Vymaže úlohu z DB
	 * @param int $id
	 * @return Nette\Database\Table\Selection
	 */
	public function deleteTask($id) {
		return $this->getTable()->where('id = ?', $id)->delete();
	}

	/**
	 * Označí úlohu v DB za splnenú
	 * @param int $id
	 */
	public function markDone($id) {
		$this->findBy(array('id' => $id))->update(array('done' => 1));
	}

}