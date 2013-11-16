<?php

namespace ToDo;


class ListRepository extends \Main\Repository {

	/**
	 * Vracia úlohy daného zoznamu
	 * @param ActiveRow $list
	 * @return \Nette\Database\Table\ActiveRow
	 */
	public function tasksOf(\Nette\Database\Table\ActiveRow $list) {
		return $list->related('task')->order('created');
	}

	/**
	 * Vytvorí nový zoznam
	 * @param string $title
	 * @return Nette\Database\Table\Selection
	 */
	public function createList($title) {
		return $this->getTable()->insert(array(
			'title' => $title
		));
	}

	/**
	 * Vykoná update zoznamu
	 * @param int $id
	 * @param array $data
	 * @return Nette\Database\Table\Selection
	 */
	public function editList($id, $data) {
		return $this->getTable()->where('id = ?', $id)->update($data);
	}

	/**
	 * Vymaže zoznam aj s úlohami, ktoré doň patria
	 * @param int $id
	 * @return Nette\Database\Table\Selection
	 */
	public function deleteList($id) {
		$this->database->table('task')->where('list_id = ?', $id)->delete();
		return $this->getTable()->where('id = ?', $id)->delete();
	}
	
}