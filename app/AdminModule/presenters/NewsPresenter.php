<?php

namespace AdminModule;

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

	/**
	 * Ešte pred vykreslením stránky
	 */
	public function beforeRender() {
		$this->template->allNews = $this->newsRepository->getAllNews();
		if ($this->isAjax()) {
			$this->invalidateControl('flashMessages');
		}
	}

	/**
	 * Vykreslenie formulára pre editáciu noviniek
	 * @param int $id
	 */
	public function renderEditNews($id) {
		$this->template->actualNews = $this->newsRepository->findById($id);
	}


	/**
	 * Formulár pre pridávanie noviniek
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentAddNewsForm() {
		
		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form-horizontal col-lg-5'));
		$renderer = $form->getRenderer();

		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';


		$form->addText('title', 'Title: *')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, 'Please enter title.');
		$form->addTextArea('body', 'Body: *', 100, 15)
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, 'Body field must be filled.');					
		$form->addSubmit('addnews', 'Add News')
			->setAttribute('class', 'btn-success pull-left');
		$form->onSuccess[] = $this->addNewsFormSubmitted;
		return $form;
	}


	/**
	 * Po úspešnom odoslaní formulára AddNewsForm
	 */
	public function addNewsFormSubmitted(Form $form) {
		$values = $form->getValues();
		$news = $this->newsRepository->addNews($values, $this->getUser()->getId());
		if ($news) {
			$this->flashMessage('You have successfully added a news.', 'success');
			$this->redirect('News:default');
		}
	}


	/**
	 * Formulár pre editáciu noviniek
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentEditNewsForm() {
		$getNews = $this->newsRepository->findById($this->getParam('id'));
		$createdBy = $this->usersRepository->findAll()->fetchPairs('id', 'username');

		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form col-lg-5'));
		$renderer = $form->getRenderer();
		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';

		$form->addText('title', 'Title: *')
			->setAttribute('class', 'form-control')
			->setDefaultValue($getNews->title)
			->addRule(Form::FILLED, 'News name must be filled!');
		$form->addTextArea('body', 'Body: *', 100, 15)
			->setAttribute('class', 'form-control')
			->setDefaultValue($getNews->body)
			->addRule(Form::FILLED, 'Body field must be filled.');
		$form->addDateTimePicker('date', 'Created: *')
			->setDefaultValue($getNews->date)
			->addRule(Form::FILLED, 'Date and time is required!');
		/*$form->addText('date', 'Created: *')
			->setAttribute('class', 'form-control')
			->setDefaultValue($getNews->date)
			->addRule(Form::FILLED, 'Date must be filled!');*/
		$form->addSelect('users_id', 'Added By: *', $createdBy)
			->setAttribute('class', 'form-control')
			->setDefaultValue($getNews->users_id);			
		$form->addSubmit('update', 'Update News')
			->setAttribute('class', 'btn-success pull-left');
		$form->onSuccess[] = $this->editNewsFormSubmitted;
		return $form;
	}


	/**
	 * Po úspešnom odoslaní formulára EditNewsForm
	 */
	public function editNewsFormSubmitted(Form $form) {
		$values = $form->getValues();
		if ($this->newsRepository->editNews($this->getParam('id'), $values)) {
			$this->flashMessage('News was successfully edited.', 'success');
			$this->redirect('News:');
		}
	}


	/**
	 * Komponenta Confirmation Dialog pre delete News
	 * @return Nette\Application\UI\Form
	 */
	public function createComponentConfirmForm() {
		$form = new \ConfirmationDialog($this->getSession('news'));
		$form->getFormElementPrototype()->addClass('ajax');

		$form->addConfirmer(
			'delete', // názov signálu bude confirmDelete!
			array($this, 'deleteNews'), // callback na funkciu pri kliknutí na YES
			array($this, 'questionDelete') // otázka
		);

		return $form;
	}

	/**
	 * Zostavenie otázky pre ConfDialog s parametrom
	 * @param Nette\Utils\Html $dialog
	 * @param array $params
	 * @return string $question
	 */
	public function questionDelete($dialog, $params) {
		$dialog->getQuestionPrototype();
		return "Do You Really Delete Item:  $params[title] ?";
	}

	/**
	 * Signál na vymazanie novinky
	 * @param int $id
	 * @return Database\Table\Selection
	 */
	public function deleteNews($id) {
		$this->newsRepository->deleteNews($id);
		if (!$this->presenter->isAjax()) {
			$this->flashMessage('News was successfully deleted!', 'delete');
			$this->redirect('this');
		} else {
			$this->invalidateControl('tableNews');
		}
	}

}