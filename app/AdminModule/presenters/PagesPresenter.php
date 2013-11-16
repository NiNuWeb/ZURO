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
		$this->template->menu = $this->pages->getPages();
	}

	public function editPage($id) {

	}

	/**
	 * Vykreslenie formulára pre editáciu Pages
	 * @param int $id
	 */
	public function renderEditPage($id) {
		$this->template->findedPage = $this->pages->findById($id);
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


		$form->addText('title', 'Title: *')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, 'Please enter title.');
		$form->addTextArea('text', 'Text: *', 100, 15)
			->addRule(Form::FILLED, 'Text field must be filled.');	
		$form->addSelect('position', 'Position: ', $select)
			->setValue($countMenuItems)
			->setAttribute('class', 'form-control');				
		$form->addSubmit('addpage', 'Add Page')
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
			$this->flashMessage('Don\'t allow title, please select another.', 'warning');
			$this->redirect('this');
		}
		if ($this->pages->countAllWithSlug($values['slug']) > 0) {
			$this->flashMessage('This title already exists, please select another.', 'warning');
			$this->redirect('this');
		}
		$new_page = $this->pages->addPage($values);
		if ($new_page) {
			$this->flashMessage('You have successfully added a new page to Main Menu.', 'success');
			$this->redirect('Pages:default');
		}
	}

	/**
	 * Formulár pre editovanie stránok do Menu
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentEditPageForm() {
		$countMenuItems = $this->pages->countMenuItems();
		for ($i=1; $i<=$countMenuItems; $i++) {
			$select[$i] = $i;
		}
		$findedPage = $this->pages->findById($this->getParam('id'));
		
		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form-horizontal col-lg-3'));
		$renderer = $form->getRenderer();

		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';


		$form->addText('title', 'Title: *')
			->setAttribute('class', 'form-control')
			->setDefaultValue($findedPage->title)
			->addRule(Form::FILLED, 'Please enter title.');
		$form->addTextArea('text', 'Text: *', 100, 15)
			->setDefaultValue($findedPage->text)
			->addRule(Form::FILLED, 'Text field must be filled.');	
		$form->addSelect('position', 'Position: ', $select)
			->setValue($findedPage->position)
			->setAttribute('class', 'form-control');				
		$form->addSubmit('editpage', 'Edit Page')
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
		if (isset($values->id)) { unset($values->id); }
		if ($values['slug'] == 'admin') {
			$this->flashMessage('Don\'t allow title, please select another.', 'warning');
			$this->redirect('this');
		}
		if ($this->pages->countAllWithSlug($values['slug']) > 0) {
			$this->flashMessage('This title already exists, please select another.', 'warning');
			$this->redirect('this');
		}
		$edited_page = $this->pages->editPage($pageid, $values);
		if ($edited_page) {
			$this->flashMessage('You have successfully edited page.', 'success');
			$this->redirect('Pages:default');
		}
	}

	/**
	 * Signál na vymazanie usera
	 * @param int $id
	 * @return Nette\Database\Table\Selection
	 */
	public function handleDeletePage($id) {
		$this->pages->deletePage($id);
		$this->flashMessage('Page was successfully deleted!', 'delete');
		$this->redirect('Pages:default');
	}
	
}