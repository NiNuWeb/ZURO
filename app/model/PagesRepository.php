<?php

namespace Main;


class PagesRepository extends Repository {

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
		return $this->getTable()->count()+1;
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
}