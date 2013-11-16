<?php

namespace AdminModule;

use Nette\Application\UI\Form as Form;

class DefaultPresenter extends BasePresenter {


	/** @var \ToDo\TaskRepository */
	public $taskRepository;

	/** @var \ToDo\ListRepository */
	public $listRepository;

	/** @var \Main\UsersRepository */
	public $usersRepository;

	/** @var \Main\NewsRepository */
	public $newsRepository;

	/**
	 * Inject TaskRepository
	 * 
	 */
	public function inject(\ToDo\TaskRepository $taskRepository, \ToDo\ListRepository $listRepository, \Main\UsersRepository $usersRepository, \Main\NewsRepository $newsRepository) {
		$this->taskRepository = $taskRepository;
		$this->listRepository = $listRepository;
		$this->usersRepository = $usersRepository;
		$this->newsRepository = $newsRepository;
	}

	/**
	 * Ešte pred vykreslením stránky
	 */
	public function beforeRender() {
		$this->template->lists = $this->listRepository->findAll()->order('title ASC');
		$this->template->tasks = $this->taskRepository->findAll()->order('id ASC');
		$this->template->news = $this->newsRepository->getXnews(5);
		if ($this->isAjax()) {
			$this->invalidateControl('flashMessages');
		}
	}

	/**
	 * Vykreslenie formulára pre editáciu zoznamu
	 * @param int $id
	 */
	public function renderEditList($id) {
		$this->template->actualList = $this->listRepository->findById($id);
	}

	/**
	 * Vykreslenie formulára pre editáciu úlohy
	 * @param int $id
	 */
	public function renderEditTask($id) {
		$this->template->actualTask = $this->taskRepository->findById($id);
	}

	/**
	 * Vytvorí komponentu s nedokončenými úlohami
	 */
	public function createComponentIncompleteTasks() {
		return new \ToDo\TaskList($this->taskRepository->findIncomplete(), $this->taskRepository);
	}

	/**
	 * Vytvorí komponentu s úlohami pre prihláseného používateľa
	 */
	public function createComponentUserTasks() {
		$incomplete = $this->taskRepository->findIncompleteByUser($this->getUser()->getId());
		$control = new \ToDo\TaskList($incomplete, $this->taskRepository);
		$control->displayList = TRUE;
		$control->displayUser = FALSE;
		return $control;
	}


	/**
	 * Formulár pre editáciu úloh
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentEditTaskForm() {
		$getTask = $this->taskRepository->findById($this->getParam('id'));
		$forUser = $this->usersRepository->findAll()->fetchPairs('id', 'username');
		$inList = $this->listRepository->findAll()->fetchPairs('id', 'title');

		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form col-lg-5'));
		$renderer = $form->getRenderer();
		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';
		$form->addText('text', 'Text: ')
			->setAttribute('class', 'form-control')
			->setDefaultValue($getTask->text)
			->addRule(Form::FILLED, 'Task text must be filled!');	
		$form->addSelect('done', 'Done: ', array('0' => 'No', '1' => 'Yes'))
			->setDefaultValue($getTask->done);
		$form->addSelect('users_id', 'For User: ', $forUser)
			->setDefaultValue($getTask->users_id);
		$form->addSelect('list_id', 'In List: ', $inList)
			->setDefaultValue($getTask->list_id);
		$form->addSubmit('update', 'Update Task')
			->setAttribute('class', 'btn-success pull-left');
		$form->onSuccess[] = $this->editTaskFormSubmitted;
		return $form;
	}


	/**
	 * Po úspešnom odoslaní formulára EditTaskForm
	 */
	public function editTaskFormSubmitted(Form $form) {
		$values = $form->getValues();
		if ($this->taskRepository->editTask($this->getParam('id'), $values)) {
			$this->flashMessage('Task was successfully edited.', 'success');
			$this->redirect('Default:editDeleteTasks');
		}
	}


	/**
	 * Formulár pre editáciu zoznamov úloh
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentEditListForm() {
		$getList = $this->listRepository->findById($this->getParam('id'));
		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form col-lg-3'));
		$renderer = $form->getRenderer();
		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';

		$form->addText('title', 'Title')
			->setAttribute('class', 'form-control')
			->setDefaultValue($getList->title)
			->addRule(Form::FILLED, 'List name must be filled!');
		$form->addSubmit('update', 'Update List')
			->setAttribute('class', 'btn-success pull-left');
		$form->onSuccess[] = $this->editListFormSubmitted;
		return $form;
	}

	/**
	 * Po úspešnom odoslaní formulára EditListForm
	 */
	public function editListFormSubmitted(Form $form) {
		$values = $form->getValues();
		if ($this->listRepository->editList($this->getParam('id'), $values)) {
			$this->flashMessage('List was successfully edited.', 'success');
			$this->redirect('Default:editDeleteLists');
		}
	}

	/**
	 * Signál na vymazanie zoznamu
	 * @param int $id
	 * @return Nette\Database\Table\Selection
	 */
	public function handleDeleteList($id) {
		$this->listRepository->deleteList($id);
		if (!$this->presenter->isAjax()) {
			$this->flashMessage('List was successfully deleted!', 'delete');
			$this->redirect('Default:editDeleteLists');
		} else {
			$this->invalidateControl('tableLists');
		}
		
	}

	/**
	 * Signál na vymazanie úlohy
	 * @param int $id
	 * @return Nette\Database\Table\Selection
	 */
	public function handleDeleteTask($id) {
		$this->taskRepository->deleteTask($id);
		if (!$this->presenter->isAjax()) {
			$this->flashMessage('Task was successfully deleted!', 'delete');
			$this->redirect('Default:editDeleteTasks');
		} else {
			$this->invalidateControl('tableTasks');
		}
		
	}

	/**
	 * Formulár pre pridávanie zoznamov úloh
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentNewListForm() {
		$form = new Form;

		$form->elementPrototype->addAttributes(array('class' => 'form col-lg-12'));
		$renderer = $form->getRenderer();
		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';

		$form->addText('title', NULL)
			->setAttribute('class', 'form-control input-sm')
			->setAttribute('placeholder', 'List Name')
			->addRule(Form::FILLED, 'Please enter list name.');
		$form->addSubmit('create', 'Add List')
			->setAttribute('class', 'btn-success pull-left');
		$form->onSuccess[] = $this->newListFormSubmitted;
		return $form;	
	}


	/**
	 * Po úspešnom odoslaní formulára NewListForm
	 */
	public function newListFormSubmitted(Form $form) {
		$list = $this->listRepository->createList($form->values->title);
		$this->flashMessage('New List Successfully Created.', 'success');
		$this->redirect('Task:default', $list->id);
	}

}