<?php

namespace AdminModule;

use Nette\Application\UI\Form;

use Nette\Security\AuthenticationException;


class AuthPresenter extends BasePresenter {

	/** @persistent */
	public $backlink;

	/**
	 * Login form Factory
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentLoginForm() {

		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form-horizontal col-lg-3'));
		$renderer = $form->getRenderer();

		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';

		$form->addText('username', 'Username:')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, 'Enter Username');
		$form->addPassword('password', 'Password:')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, 'Enter Password');
		$form->addSubmit('send', 'Log In')
			->setAttribute('class', 'btn-danger pull-left');;
		
		$form->onSuccess[] = $this->processLoginForm;

		return $form;		
	}


	/**
	 * Process login form and login user
	 * @param Nette\Application\UI\Form
	 */
	public function processLoginForm(Form $form) {
		$values = $form->getValues(TRUE);

		try {
			$this->user->login($values['username'], $values['password']);
			$this->restoreRequest($this->backlink);
			$this->redirect('Default:default');
		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		}

	}

}