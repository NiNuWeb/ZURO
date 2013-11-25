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
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findBySlug($slug) {
		return $this->findBy(array('slug' => $slug))->fetch();
	}

	/**
	 * Vráti prvý záznam z tabuľky Pages
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findFirstPage() {
		return $this->getTable()->get(1);
	}

	/**
	 * Vráti páry, slug do url adresy, title do menu z tabuľky Pages
	 * @return Nette\Database\Table\Selection
	 */
	public function getMenu() {
		return $this->getTable()->order('position')->fetchPairs('slug', 'title');
	}

	/**
	 * Vráti počet slugov, ktoré sú zhodné s hladaným slugom
	 * @param string $slug
	 * @return int or NULL
	 */
	public function countAllWithSlug($slug) {
		return $this->findBy(array('slug' => $slug))->count();
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
	 * @return Nette\Database\Table\Selection
	 */
	public function addPage($data) {
		return $this->getTable()->insert($data);
	}

	/**
	 * Editovanie stránky
	 * @param int $id
	 * @param array $data
	 * @return Nette\Database\Table\Selection
	 */
	public function editPage($id, $data) {
		return $this->getTable()->where('id = ?', $id)->update($data);
	}

	/**
	 * Signál na vymazanie stránky z menu
	 * @param int $id
	 * @return Nette\Database\Table\Selection
	 */
	public function deletePage($id) {
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
				$this->editPage($page->id, array('position' => $page->position));
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
				$this->editPage($page->id, array('position' => $page->position));
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
					$this->editPage($actualPosRow->id, array('position' => $nextRow->position));
					$this->editPage($nextRow->id, array('position' => $actualPosition));
					$actualPosition++;
				}
			} elseif ($actualPosition > $newPosition) {
				$changes = $actualPosition - $newPosition;
				for ($i = 0; $i < $changes; $i++) {
					$actualPosRow = $this->findBy(array('position' => $actualPosition))->fetch();
					$beforeRow = $this->findBy(array('position' => $actualPosition-1))->fetch();
					$this->editPage($this->find($actualPosRow->id), array('position' => $beforeRow->position));
					$this->editPage($beforeRow->id, array('position' => $actualPosition));
					$actualPosition--;
				}
			}
		}

		return $this;
	}

}