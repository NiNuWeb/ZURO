<?php

namespace Main;


class PagesRepository extends Repository {

	/** @var Nette\Database\Table\Selection */
	private $actualPosRow;

	/**
	 * Vráti pages zoradené podľa positon
	 * @return Nette\Database\Table\Selection
	 */
	public function getPages() {
		return $this->getTable()->order('position');
	}

	/**
	 * Vráti záznam z tabuľky podľa $slug-u
	 * @param string $slug
	 * @param string $lang
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findBySlug($slug, $lang) {
		$idOfSlug = $this->database->table('pages_translation')->where('slug = ?', $slug)->fetch();
		return $this->database->table('pages_translation')->where('language_code = ? && pages_id = ?', $lang, $idOfSlug->pages_id)->fetch();
	}

	/**
	 * Vráti prvý záznam z tabuľky Pages
	 * @param string $lang
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findFirstPage($lang) {
		$id = "1";
		return $this->database->table('pages_translation')->where('language_code = ? && pages_id = ?', $lang, $id)->fetch();
	}

	/**
	 * Vráti páry, slug do url adresy, title do menu z tabuľky Pages
	 * @param string $lang
	 * @return Nette\Database\Table\Selection
	 */
	public function getMenu($lang) {
		return $this->database->table('pages_translation')->where('language_code = ?', $lang)->where('pages_id = pages.id')->order('pages.position');
	}

	/**
	 * Vráti počet slugov, ktoré sú zhodné s hladaným slugom
	 * @param string $slug
	 * @param string $lang
	 * @return int or NULL
	 */
	public function countAllWithSlug($slug, $lang) {
		return $this->database->table('pages_translation')->where('slug = ? && language_code = ?', $slug, $lang)->count();
	}

	/**
	 * Vráti array - počet items v menu + 1 - do selectu pri pridavaní do menu
	 * @return int
	 */
	public function countMenuItems() {
		return $this->getTable()->count('*')+1;
	}

	/**
	 * Pridá stránku do menu
	 * @param array $data
	 * @param string $lang
	 * @return Nette\Database\Table\Selection
	 */
	public function addPage($data, $lang) {
		$newPage = $this->getTable()->insert(array(
			'position' => $data['position']
		));
		return $this->database->table('pages_translation')->insert(array(
			'pages_id' => $newPage->id,
			'language_code' => $lang,
			'title' => $data['title'],
			'text' => $data['text'],
			'slug' => $data['slug']
		));
	}

	/**
	 * Editovanie stránky
	 * @param int $id
	 * @param array $data
	 * @param string $lang
	 * @return Nette\Database\Table\Selection
	 */
	public function editPage($id, $data, $lang) {
		return $this->database->table('pages_translation')->where('pages_id = ? && language_code = ?', $id, $lang)->update(array(
		'title' => $data['title'],
		'text' => $data['text'],
		'slug' => $data['slug']
		));
	}

	/**
	 * Editovanie pozície
	 * @param int $id
	 * @param array $data
	 * @return Nette\Database\Table\Selection
	 */
	public function editPosition($id, $data) {
		return $this->getTable()->where('id = ?', $id)->update($data);
	}

	/**
	 * Signál na vymazanie stránky z menu
	 * @param int $id
	 * @return Nette\Database\Table\Selection
	 */
	public function deletePage($id) {
		$this->database->table('pages_translation')->where('pages_id = ?', $id)->delete();
		return $this->getTable()->where('id = ?', $id)->delete();
	}

	/**
	 * Zmena pozície ostatných položiek pri pridaní novej do menu
	 * @param int $itemAddedToPosition
	 */
	public function editPositions($itemAddedToPosition) {
		$allPages = $this->getPages();
		foreach ($allPages as $page) {
			if ($page->position >= $itemAddedToPosition) {
				$page->position = $page->position + 1;
				$this->editPosition($page->id, array('position' => $page->position));
			}
		}
	}

	/**
	 * Zmena pozície ostatných položiek pri vymazaní položky z menu
	 * @param int $itemDeletedFromPosition
	 */
	public function deletedItemPositions($itemDeletedFromPosition) {
		$allPages = $this->getPages();
		foreach ($allPages as $page) {
			if ($page->position >= $itemDeletedFromPosition) {
				$page->position = $page->position - 1;
				$this->editPosition($page->id, array('position' => $page->position));
			}
		}
	}


	public function updatePositions($actualPosition, $newPosition) {
		if ($actualPosition != $newPosition) {
			if ($actualPosition < $newPosition) {
				$changes = $newPosition - $actualPosition;
				for ($i = 0; $i < $changes; $i++) {
					$actualPosRow = $this->findBy(array('position' => $actualPosition))->fetch();
					$nextRow = $this->findBy(array('position' => $actualPosition+1))->fetch();
					$this->editPosition($actualPosRow->id, array('position' => $nextRow->position));
					$this->editPosition($nextRow->id, array('position' => $actualPosition));
					$actualPosition++;
				}
			} elseif ($actualPosition > $newPosition) {
				$changes = $actualPosition - $newPosition;
				for ($i = 0; $i < $changes; $i++) {
					$actualPosRow = $this->findBy(array('position' => $actualPosition))->fetch();
					$beforeRow = $this->findBy(array('position' => $actualPosition-1))->fetch();
					$this->editPosition($this->find($actualPosRow->id), array('position' => $beforeRow->position));
					$this->editPosition($beforeRow->id, array('position' => $actualPosition));
					$actualPosition--;
				}
			}
		}

		return $this;
	}

	/**
	 * Vyberie z db jednu stránku podľa id a jazyka
	 * @param int $id
	 * @param string $lang
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findSinglePage($id, $lang) {
		return $this->database->table('pages_translation')->where('pages_id = ? && language_code = ?', $id, $lang)->fetch();
	}

	/**
	 * Pridanie prekladu
	 * @param array $data
	 * @param string $lang
	 * @return Nette\Database\Table\Selection
	 */
	public function addTranslation($data) {
		$this->getTable()->where('id = ?', $data['pages_id'])->update(array('translated' => 1));
		return $this->database->table('pages_translation')->insert(array(
			'pages_id' => $data['pages_id'],
			'language_code' => $data['translate_to'],
			'title' => $data['title'],
			'text' => $data['text'],
			'slug' => $data['slug']
		));
	}

}