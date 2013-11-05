<?php

namespace FrontModule;

use Nette\Application\UI,
	Nette\Application\UI\Form as Form;

class RegisterPresenter extends BasePresenter {

	/** @var Users */
	public $users;


	/**
	 * Inject UsersRepository
	 * @var usersRepository
	 */
	public function injectUsersRepository(\Main\UsersRepository $usersRepository) {
		$this->users = $usersRepository;
	}

	// Tu sa nastvuje, čo sa posiela do template
	public function beforeRender() {
		$this->setLayout('registration'); // nastavený iný layout, kde nie je menu
	}

	/**
	 * Vytvorí registračný formulár
	 * @return $form
	 */
	protected function createComponentRegisterForm() {
		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form-horizontal col-lg-3'));
		$renderer = $form->getRenderer();

		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';

		$form->addText('username', 'Username: *')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, 'Please enter username.');
		$form->addPassword('password', 'Password: *', 20)
			->setOption('description', '(Mininal 6 characters)')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, 'Please enter password.')
			->addRule(Form::MIN_LENGTH, 'The Password must be min %d characters long.', 6);
		$form->addPassword('password2', 'Password again: *', 20)
			->setAttribute('class', 'form-control')
			->addConditionOn($form['password'], Form::VALID)
			->addRule(Form::FILLED, 'Password again please.')
			->addRule(Form::EQUAL, 'Passwords must match.', $form['password']);
		$form->addText('email', 'E-mail: *', 35)
			->setEmptyValue('@')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, 'Please enter your e-mail.')
			->addCondition(Form::FILLED)
			->addRule(Form::EMAIL, 'Invalid E-mail address!');
		$form->addSubmit('register', 'Register')
			->setAttribute('class', 'btn-success pull-left');
		$form->onSuccess[] = callback($this, 'registerFormSubmitted');
		return $form;			
	}

	/**
	 * Vykonanie registrácie po úspešnej validácii formulára
	 */
	public function registerFormSubmitted(UI\Form $form) {
		$values = $form->getValues();
		$new_user = $this->users->register($values);
		if ($new_user) {
			$this->flashMessage('You were successfully registered.', 'success');
			$this->redirect('Sign:in');
		}
	}
}