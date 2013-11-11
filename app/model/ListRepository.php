<?php

namespace ToDo;


class ListRepository extends \Main\Repository {

	public function tasksOf(\Nette\Database\Table\ActiveRow $list) {
		return $list->related('task')->order('created');
	}

	public function createList($title) {
		return $this->getTable()->insert(array(
			'title' => $title
		));
	}

	public function editList($id, $data) {
		return $this->getTable()->where('id = ?', $id)->update($data);
	}

	public function deleteList($id) {
		$this->database->table('task')->where('list_id = ?', $id)->delete();
		return $this->getTable()->where('id = ?', $id)->delete();
	}
	
}