<?php

namespace Main;


class NewsRepository extends Repository {

	/**
	 * Vybratie všetkých noviniek
	 * @param string $lang
	 * @return Nette\Database\Table\Selection
	 */
	public function getAllNews($lang) {
		return $this->database->table('news_translation')->where('language_code = ?', $lang)->where('news_id = news.id')->order('date DESC');
	}

	/**
	 * Vybratie posledných X noviniek
	 * @param int $limit
	 * @param string $lang
	 * @return Nette\Database\Table\Selection
	 */
	public function getXnews($limit, $lang) {
		return $this->database->table('news_translation')->where('language_code = ?', $lang)->where('news_id = news.id')->order('date DESC')->limit($limit);
	}

	/**
	 * Pridanie novinky
	 * @param array $data
	 * @param int $user
	 * @return Nette\Database\Table\Selection
	 */
	public function addNews($data, $user, $lang) {
		$data['date'] = new \DateTime();
		$data['users_id'] = $user;
		$addNews = $this->getTable()->insert(array(
			'date' => $data['date'],
			'users_id' => $data['users_id']
		));
		return $this->database->table('news_translation')->insert(array(
			'news_id' => $addNews->id,
			'language_code' => $lang,
			'title' => $data['title'],
			'body' => $data['body']
		));
	}

	/**
	 * Pridanie prekladu
	 * @param array $data
	 * @param string $lang
	 * @return Nette\Database\Table\Selection
	 */
	public function addTranslation($data) {
		$this->getTable()->where('id = ?', $data['news_id'])->update(array('translated' => 1));
		return $this->database->table('news_translation')->insert(array(
			'news_id' => $data['news_id'],
			'language_code' => $data['translate_to'],
			'title' => $data['title'],
			'body' => $data['body']
		));
	}

	/**
	 * Vymaže novinku z DB
	 * @param int $id
	 * @return Nette\Database\Table\Selection
	 */
	public function deleteNews($id) {
		$this->database->table('news_translation')->where('news_id = ?', $id)->delete();
		return $this->getTable()->where('id = ?', $id)->delete();
	}

	/**
	 * Edituje novinky z formulára
	 * @param int $id
	 * @param array $data
	 * @param string $lang
	 * @return Nette\Database\Table\Selection
	 */
	public function editNews($id, $data, $lang) {
		$this->getTable()->where('id = ?', $id)->update(array(
			'date' => $data['date'],
			'users_id' => $data['users_id']
		));
		$this->database->table('news_translation')->where('news_id = ? && language_code = ?', $id, $lang)->update(array(
		'title' => $data['title'],
		'body' => $data['body']
		));
		
		return true;
	}

	/**
	 * Vyberie z db jednu novinku podľa id a jazyka
	 * @param int $id
	 * @param string $lang
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findSingleNews($id, $lang) {
		return $this->database->table('news_translation')->where('news_id = ? && language_code = ?', $id, $lang)->fetch();
	}

}