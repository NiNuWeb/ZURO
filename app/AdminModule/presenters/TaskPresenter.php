<?php

namespace AdminModule;

use Nette\Application\UI\Form as Form,
	Nette\Utils\Html;

class TaskPresenter extends BasePresenter {
	
	/** @var \ToDo\ListRepository */
	public $listRepository;

	/** @var \Main\ListRepository */
	public $usersRepository;

	/** @var \ToDo\TaskRepository */
	public $taskRepository;

	/** @var \Nette\Database\Table\ActiveRow */
	private $list;

	/**
	 * Inject repozirárov
	 * 
	 */
	public function inject(\ToDo\ListRepository $listRepository, \Main\UsersRepository $usersRepository, \ToDo\TaskRepository $taskRepository) {
		$this->listRepository = $listRepository;
		$this->usersRepository = $usersRepository;
		$this->taskRepository = $taskRepository;
	}

	/**
	 * Do premennej $list uložíme zoznam úloh podľa id
	 */
	public function actionDefault($id) {
		$this->list = $this->listRepository->find($id);
		if ($this->list === FALSE) {
			$this->setView('notFound');
		}
	}

	/**
	 * Do šablóny pošle úlohy, ktoré zodpovedajú zoznamu, napr. len pre Home
	 * @param int $id
	 */
	public function renderDefault($id) {
		$this->template->list = $this->list;
		$this->template->lists = $this->listRepository->findAll()->order('title ASC');
	}

	/**
	 * Vlastná komponenta TaskList
	 */
	protected function createComponentTaskList() {
		if ($this->list === NULL) {
			$this->error('Wrong action');
		}
		return new \ToDo\TaskList($this->listRepository->tasksOf($this->list), $this->taskRepository);
	}

	/**
	 * Formulár pre pridávanie úloh
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentTaskForm() {
		$userPairs = $this->usersRepository->findAll()->fetchPairs('id', 'username');

		$form = new Form;
		$form->addText('text', 'Task:', 40, 100)
			->addRule(Form::FILLED, 'You must fill task field.');
		$prompt = Html::el('option')->setText("- Select -")->class('prompt');	
		$form->addSelect('userId', 'For:', $userPairs)
			->setPrompt($prompt)
			->addRule(Form::FILLED, 'Please select username, for who\'s the task is.')
			->setDefaultValue($this->getUser()->getId());
		$form->addSubmit('create', 'Add')
			->setAttribute('class', 'btn btn-success');
		$form->onSuccess[] = $this->taskFormSubmitted;	
		return $form;		
	}

	/**
	 * Úspešné vykonanie formulára TaskForm
	 */
	public function taskFormSubmitted(Form $form) {
		$this->taskRepository->createTask($this->list->id, $form->values->text, $form->values->userId);
		$this->flashMessage('Task successfully added.', 'success');
		if (!$this->isAjax()) {
			$this->redirect('this');	
		} else {
			$form->setValues(array('userId' => $form->values->userId), TRUE);
			$this->invalidateControl('form');
			$this['taskList']->invalidateControl();
		}
		
	}


}