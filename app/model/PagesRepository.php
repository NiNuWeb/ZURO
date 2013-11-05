<?php

namespace Main;


class PagesRepository extends Repository {

	/**
	 * Vráti celú tabuľku pages
	 */
	public function getPages() {
		return $this->getTable()->order('position');
	}

	/**
	 * Vráti všetky záznami z tabuľky, ktoré sa rovnajú $slug
	 */
	public function findBySlug($slug) {
		return $this->findBy(array('slug' => $slug))->fetch();
	}

	/**
	 * Vráti prvý záznam z tabuľky
	 */
	public function findFirstPage() {
		return $this->getTable()->get(1);
	}

	/**
	 * Vráti páry, slug do adresy, title do menu
	 */
	public function getMenu() {
		return $this->getTable()->order('position')->fetchPairs('slug', 'title');
	}

	/**
	 * Vráti počet slugov, ktoré sú zhodné s hladaným slugom
	 */
	public function countAllWithSlug($slug) {
		return $this->findBy(array('slug' => $slug))->count();
	}

	/**
	 * Vráti array - počet items v menu + 1 - do selectu pri pridavaní do menu
	 */
	public function countMenuItems() {
		return $this->getTable()->count()+1;
	}

	/**
	 * Pridá stránku do menu
	 * @return Nette\Database\Table\Selection
	 */
	public function addPage($data) {
		return $this->getTable()->insert($data);
	}

	/**
	 * Editovanie stránky
	 * @return Nette\Database\Table\Selection
	 */
	public function editPage($id, $data) {
		return $this->getTable()->where('id = ?', $id)->update($data);
	}

	/**
	 * Signál na vymazanie stránky z menu
	 * @return Nette\Database\Table\Selection
	 */
	public function deletePage($id) {
		return $this->getTable()->where('id = ?', $id)->delete();
	}
}