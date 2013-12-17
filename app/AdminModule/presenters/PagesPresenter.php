<?php

namespace AdminModule;

use Nette\Diagnostics\Debugger,
	Nette\Application\UI,
	Nette\Application\UI\Form as Form,
	Nette\Templating\Helpers,
	Nette\Utils\Strings;

class PagesPresenter extends BasePresenter {

	/** @var \Main\PagesRepository */
	private $pages;

	/** @var \Nette\Database\Table\ActiveRow */
	private $pageTranslate;

	/**
	 * Inject repozitárov
	 * 
	 */
	public function inject(\Main\PagesRepository $pagesRepository) {
		$this->pages = $pagesRepository;
	}

	/**
	 * Vykreslenie Pages
	 */
	public function renderDefault() {
		$this->template->menu = $this->pages->getMenu($this->translator->getLocale());
	}

	/**
	 * Vykreslenie formulára pre editáciu Pages
	 * @param int $id
	 */
	public function renderEditPage($id) {
		$this->template->findedPage = $this->pages->findSinglePage($id, $this->translator->getLocale());
		if ($this->template->findedPage === FALSE) {
			$this->setView('notFound');
		}
	}

	public function renderAddTranslation($id) {
		$this->template->translatePage = $this->pages->findSinglePage($id, $this->translator->getLocale());
	}

	public function actionAddTranslation($id) {
		$this->pageTranslate = $this->pages->findSinglePage($id, $this->translator->getLocale());
		if ($this->pageTranslate === FALSE) {
			$this->setView('notFound');
		}
	}

	/**
	 * Formulár pre pridávanie stránok do Menu
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentAddPageForm() {
		$countMenuItems = $this->pages->countMenuItems();
		for ($i=1; $i<=$countMenuItems; $i++) {
			$select[$i] = $i;
		}
		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form-horizontal col-lg-3'));
		$renderer = $form->getRenderer();

		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';


		$form->addText('title', $this->translator->translate('messages.admin.menu.formTitle').': *')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, $this->translator->translate('messages.admin.menu.enterTitle'));
		$form->addTextArea('text', $this->translator->translate('messages.admin.menu.formText').': *', 100, 15)
			->addRule(Form::FILLED, $this->translator->translate('messages.admin.menu.fillText'));	
		$form->addSelect('position', $this->translator->translate('messages.admin.menu.formPosition').': ', $select)
			->setValue($countMenuItems)
			->setAttribute('class', 'form-control');				
		$form->addSubmit('addpage', $this->translator->translate('messages.admin.menu.addPage'))
			->setAttribute('class', 'btn-success pull-left');
		$form->onSuccess[] = callback($this, 'addPageFormSubmitted');
		return $form;
	}

	/**
	 * Pridanie usera po úspešnej validácii formulára
	 */
	public function addPageFormSubmitted(UI\Form $form) {
		$values = $form->getValues();
		$values['slug'] = Strings::webalize($values->title);
		if ($values['slug'] == 'admin') {
			$this->flashMessage($this->translator->translate('messages.admin.menu.dontAllowTitle'), 'warning');
			$this->redirect('this');
		}
		if ($this->pages->countAllWithSlug($values['slug'],  $this->translator->getLocale()) > 0) {
			$this->flashMessage($this->translator->translate('messages.admin.menu.existsTitle'), 'warning');
			$this->redirect('this');
		}
		
		$this->pages->editPositions($values['position']);
		$new_page = $this->pages->addPage($values, $this->translator->getLocale());
		if ($new_page) {
			$this->flashMessage($this->translator->translate('messages.admin.menu.addPageSucc'), 'success');
			$this->redirect('Pages:default');
		}
	}

	/**
	 * Formulár pre editovanie stránok do Menu
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentEditPageForm() {
		$countMenuItems = $this->pages->countMenuItems()-1;
		for ($i=1; $i<=$countMenuItems; $i++) {
			$select[$i] = $i;
		}
		$findedPage = $this->pages->findSinglePage($this->getParam('id'), $this->translator->getLocale());
		
		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form-horizontal col-lg-3'));
		$renderer = $form->getRenderer();

		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';


		$form->addText('title', $this->translator->translate('messages.admin.menu.formTitle').': *')
			->setAttribute('class', 'form-control')
			->setDefaultValue($findedPage->title)
			->addRule(Form::FILLED, $this->translator->translate('messages.admin.menu.enterTitle'));
		$form->addTextArea('text', $this->translator->translate('messages.admin.menu.formText').': *', 100, 15)
			->setDefaultValue($findedPage->text)
			->addRule(Form::FILLED, $this->translator->translate('messages.admin.menu.fillText'));	
		$form->addSelect('position', $this->translator->translate('messages.admin.menu.position').': ', $select)
			->setValue($findedPage->pages->position)
			->setAttribute('class', 'form-control');				
		$form->addSubmit('editpage', $this->translator->translate('messages.admin.menu.editPage'))
			->setAttribute('class', 'btn-success pull-left');
		$form->onSuccess[] = callback($this, 'editPageFormSubmitted');
		return $form;
	}

	/**
	 * Editácia stránky po úspešnej validácii formulára
	 */
	public function editPageFormSubmitted(UI\Form $form) {
		$values = $form->getValues();
		$values['slug'] = Strings::webalize($values->title);
		$pageid = $this->getParam('id');
		$actualPageSlug = $this->pages->findSinglePage($pageid, $this->translator->getLocale());
		if (isset($values->id)) { unset($values->id); }
		if ($values['slug'] == 'admin') {
			$this->flashMessage($this->translator->translate('messages.admin.menu.dontAllowTitle'), 'warning');
			$this->redirect('this');
		}
		if ($this->pages->countAllWithSlug($values['slug'], $this->translator->getLocale()) > 0 && $values['slug'] !== $actualPageSlug->slug) {
			$this->flashMessage($this->translator->translate('messages.admin.menu.existsTitle'), 'warning');
			$this->redirect('this');
		}

		$updatePosition = $this->pages->updatePositions($actualPageSlug->pages->position, $values['position']);
		if ($updatePosition) {
			unset($values['position']);
			$edited_page = $this->pages->editPage($pageid, $values, $this->translator->getLocale());
			$this->flashMessage($this->translator->translate('messages.admin.menu.editPageSucc'), 'success');
			$this->redirect('Pages:default');
				
		}
		
	}

	/**
	 * Komponenta Confirmation Dialog pre delete Page
	 * @return Nette\Application\UI\Form
	 */
	public function createComponentConfirmForm() {
		$form = new \ConfirmationDialog($this->getSession('pages'));
		$form->getFormElementPrototype()->addClass('ajax');

		$form->addConfirmer(
			'delete', // názov signálu bude confirmDelete!
			array($this, 'deletePage'), // callback na funkciu pri kliknutí na YES
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
		return $this->translator->translate('messages.admin.menu.deletePageConfirm').":  $params[title] ?";
	}

	/**
	 * Signál na vymazanie usera
	 * @param int $id
	 * @return Nette\Database\Table\Selection
	 */
	public function deletePage($id) {
		$page = $this->pages->findById($id);
		$this->pages->deletedItemPositions($page->position);
		$this->pages->deletePage($id);
		if (!$this->presenter->isAjax()) {
			$this->flashMessage($this->translator->translate('messages.admin.menu.deletedPage'), 'delete');
			$this->redirect('Pages:default');
		} else {
			$this->invalidateControl('tablePages');
		}
	}

	/**
	 * Formulár pre pridávanie prekladov
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentAddTranslationForm() {
		$translation_language = ($this->translator->getLocale() == "en") ? "sk" : "en";
		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form-horizontal col-lg-10'));
		$renderer = $form->getRenderer();

		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';

		$form->addHidden('pages_id')->setDefaultValue($this->getParameter('id'));
		$form->addHidden('translate_to')->setDefaultValue($translation_language);
		$form->addText('title', $this->translator->translate('messages.admin.menu.formTitle').': *')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, $this->translator->translate('messages.admin.menu.enterTitle'));
		$form->addTextArea('text', $this->translator->translate('messages.admin.menu.formText').': *', 100, 15)
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, $this->translator->translate('messages.admin.menu.fillText'));
		$form->addSubmit('addtranslation', $this->translator->translate('messages.admin.menu.addTranslation'))
			->setAttribute('class', 'btn-success pull-left');
		$form->onSuccess[] = $this->translationFormSubmitted;
		return $form;
	}


	/**
	 * Po úspešnom odoslaní formulára translationForm
	 */
	public function translationFormSubmitted(Form $form) {
		$values = $form->getValues();
		$values['slug'] = Strings::webalize($values->title);

		if ($values['slug'] == 'admin') {
			$this->flashMessage($this->translator->translate('messages.admin.menu.dontAllowTitle'), 'warning');
			$this->redirect('this');
		}
		if ($this->pages->countAllWithSlug($values['slug'], $values['translate_to']) > 0) {
			$this->flashMessage($this->translator->translate('messages.admin.menu.existsTitle'), 'warning');
			$this->redirect('this');
		}

		$translation = $this->pages->addTranslation($values);
		if ($translation) {
			$this->flashMessage($this->translator->translate('messages.admin.menu.translationAddSucc'), 'success');
			$this->redirect('Pages:default');
		}
	}
	
}