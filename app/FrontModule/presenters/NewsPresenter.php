<?php

namespace FrontModule;

use Nette\Application\UI\Form as Form;

class NewsPresenter extends BasePresenter {


	/** @var \Main\NewsRepository */
	public $newsRepository;

	/** @var \Main\ListRepository */
	public $usersRepository;

	/**
	 * Inject Repositories
	 *
	 */
	public function inject(\Main\NewsRepository $newsRepository, \Main\UsersRepository $usersRepository) {
		$this->newsRepository = $newsRepository;
		$this->usersRepository = $usersRepository;
	}

	// Pred vykreslením noviniek
	public function beforeRender() {
		$this->setLayout('registration'); // nastavený iný layout, kde nie je menu
	}

	/**
	 * Vykreslenie stránky single
	 * @param int $id
	 */
	public function renderSingle($id) {
		$this->template->singleNews = $this->newsRepository->findSingleNews($id, $this->translator->getLocale());
	}


}