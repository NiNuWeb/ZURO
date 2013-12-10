<?php

namespace AdminModule;

use Nette\Diagnostics\Debugger,
	Nette\Application\UI,
	Nette\Application\UI\Form as Form;

class UsersPresenter extends BasePresenter {

	/** @var Users */
	private $users;

	/**
	 * Inject repozirárov
	 * 
	 */
	public function inject(\Main\UsersRepository $usersRepository) {
		$this->users = $usersRepository;
	}


	// do render defaultu (pre Manage Users) pošle tabuľku so všetkými usermi
	public function renderDefault() {
		$this->template->userList = $this->users->findAllUsers();
	}

	public function editUser($id) {

	}

	/**
	 * Vykreslenie formulára pre editáciu používateľov
	 * @param int $id
	 */
	public function renderEditUser($id) {
		$this->template->findedUser = $this->users->findById($id);
	}

	/**
	 * Formulár pre pridávanie userov
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentAddUserForm() {
		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form-horizontal col-lg-3'));
		$renderer = $form->getRenderer();
		$user_roles = array('admin', 'editor', 'guest');

		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';


		$form->addText('username', $this->translator->translate('messages.admin.user.username').': *')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, $this->translator->translate('messages.admin.user.fillUsername'));
		$form->addPassword('password', $this->translator->translate('messages.admin.user.password').': *', 20)
			->setOption('description', $this->translator->translate('messages.admin.user.minChar'))
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, $this->translator->translate('messages.admin.user.fillPass'))
			->addRule(Form::MIN_LENGTH, $this->translator->translate('messages.admin.user.minPassChar'), 6);
		$form->addText('first_name', $this->translator->translate('messages.admin.user.firstName'))
			->setAttribute('class', 'form-control');
		$form->addText('last_name', $this->translator->translate('messages.admin.user.lastName'))
			->setAttribute('class', 'form-control');		
		$form->addText('email', $this->translator->translate('messages.admin.user.email').': *', 35)
			->setEmptyValue('@')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, $this->translator->translate('messages.admin.user.fillEmail'))
			->addCondition(Form::FILLED)
				->addRule(Form::EMAIL, $this->translator->translate('messages.admin.user.invalidEmail'));
		$form->addSelect('active', $this->translator->translate('messages.admin.user.active').': ', array(0 => 'no',1 => 'yes'))
			->setValue(1)
			->setAttribute('class', 'form-control');
		$form->addSelect('role', $this->translator->translate('messages.admin.user.role').': ')
			->setItems($user_roles, FALSE)
			->setValue('guest')
			->setAttribute('class', 'form-control');
		$form->addTextArea('profile', $this->translator->translate('messages.admin.user.profile').': ')
			->addRule(Form::MAX_LENGTH, $this->translator->translate('messages.admin.user.maxProfText'), 100);				
		$form->addSubmit('adduser', $this->translator->translate('messages.admin.user.addUser'))
			->setAttribute('class', 'btn-success pull-left');
		$form->onSuccess[] = callback($this, 'addUserFormSubmitted');
		return $form;
	}

	/**
	 * Pridanie usera po úspešnej validácii formulára
	 */
	public function addUserFormSubmitted(UI\Form $form) {
		$values = $form->getValues();
		$new_user = $this->users->addUser($values);
		if ($new_user) {
			$this->flashMessage($this->translator->translate('messages.admin.user.addUserSucc'), 'success');
			$this->redirect('Users:default');
		}
	}


	/**
	 * Formulár pre editáciu userov
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentEditUserForm() {
		$getUser = $this->users->findById($this->getParam('id'));

		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form-horizontal col-lg-3'));
		$renderer = $form->getRenderer();
		$user_roles = array('admin', 'editor', 'guest');

		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';


		$form->addText('username', $this->translator->translate('messages.admin.user.username').': *')
			->setAttribute('class', 'form-control')
			->setDefaultValue($getUser->username)
			->addRule(Form::FILLED, $this->translator->translate('messages.admin.user.fillUsername'));
		$form->addPassword('password', $this->translator->translate('messages.admin.user.password').': *', 20)
			->setOption('description', $this->translator->translate('messages.admin.user.minChar'))
			->setAttribute('class', 'form-control');
		$form->addText('first_name', $this->translator->translate('messages.admin.user.firstName'))
			->setAttribute('class', 'form-control')
			->setDefaultValue($getUser->first_name);
		$form->addText('last_name', $this->translator->translate('messages.admin.user.lastName'))
			->setAttribute('class', 'form-control')
			->setDefaultValue($getUser->last_name);		
		$form->addText('email', $this->translator->translate('messages.admin.user.email').': *', 35)
			->setEmptyValue('@')
			->setAttribute('class', 'form-control')
			->setDefaultValue($getUser->email)
			->addRule(Form::FILLED, $this->translator->translate('messages.admin.user.fillEmail'))
			->addCondition(Form::FILLED)
				->addRule(Form::EMAIL, $this->translator->translate('messages.admin.user.invalidEmail'));
		$form->addSelect('active', $this->translator->translate('messages.admin.user.active').': ', array(0 => 'no',1 => 'yes'))
			->setValue($getUser->active)
			->setAttribute('class', 'form-control');
		$form->addSelect('role', $this->translator->translate('messages.admin.user.role').': ')
			->setItems($user_roles, FALSE)
			->setValue($getUser->role)
			->setAttribute('class', 'form-control');
		$form->addTextArea('profile', $this->translator->translate('messages.admin.user.profile').': ')
			->setValue($getUser->profile)
			->addRule(Form::MAX_LENGTH, $this->translator->translate('messages.admin.user.maxProfText'), 100);				
		$form->addSubmit('edituser', $this->translator->translate('messages.admin.user.editUser'))
			->setAttribute('class', 'btn-success pull-left');
		$form->onSuccess[] = callback($this, 'editUserFormSubmitted');
		return $form;
	}

	/**
	 * Editovanie usera po úspešnej validácii formulára
	 */
	public function editUserFormSubmitted(UI\Form $form) {
		$values = $form->getValues();
		$userid = $this->getParam('id');
		if (isset($values->id)) { unset($values->id); }
		if(!$values->password) {
			unset($values->password);
		}
		if ($this->users->editUser($userid, $values)) {
			$this->flashMessage($this->translator->translate('messages.admin.user.editUserSucc'), 'success');
			$this->redirect('Users:default');
		}
	}

	/**
	 * Komponenta Confirmation Dialog pre delete User
	 * @return Nette\Application\UI\Form
	 */
	public function createComponentConfirmForm() {
		$form = new \ConfirmationDialog($this->getSession('users'));
		$form->getFormElementPrototype()->addClass('ajax');

		$form->addConfirmer(
			'delete', // názov signálu bude confirmDelete!
			array($this, 'deleteUser'), // callback na funkciu pri kliknutí na YES
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
		return $this->translator->translate('messages.admin.user.deleteUserConfirm').":  $params[username] ?";
	}

	/**
	 * Signál na vymazanie usera
	 * @param int $id
	 */
	public function deleteUser($id) {
		$this->users->deleteUser($id);
		if (!$this->presenter->isAjax()) {
			$this->flashMessage($this->translator->translate('messages.admin.user.deleteUser'), 'delete');
			$this->redirect('Users:default');
		} else {
			$this->invalidateControl('tableUsers');
		}
	}



}