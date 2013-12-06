<?php

namespace FrontModule;

use Nette\Application\UI,
	Nette\Application\UI\Form as Form;

class RegisterPresenter extends BasePresenter {

	/** @var \Main\UsersRepository */
	public $users;


	/**
	 * Inject UsersRepository
	 * 
	 */
	public function injectUsersRepository(\Main\UsersRepository $usersRepository) {
		$this->users = $usersRepository;
	}

	// Pred vykreslením Registračného formulára
	public function beforeRender() {
		$this->setLayout('registration'); // nastavený iný layout, kde nie je menu
	}

	/**
	 * Vytvorí registračný formulár
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentRegisterForm() {
		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form-horizontal col-lg-3'));
		$renderer = $form->getRenderer();

		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';

		$form->addText('username', $this->translator->translate("messages.registerForm.username").': *')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, $this->translator->translate("messages.registerForm.enterusername"));
		$form->addPassword('password', $this->translator->translate("messages.registerForm.password").': *', 20)
			->setOption('description', '('.$this->translator->translate("messages.registerForm.minChar").')')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, $this->translator->translate("messages.registerForm.enterpassword"))
			->addRule(Form::MIN_LENGTH, $this->translator->translate("messages.registerForm.passChar"), 6);
		$form->addPassword('password2', $this->translator->translate("messages.registerForm.passAgain").': *', 20)
			->setAttribute('class', 'form-control')
			->addConditionOn($form['password'], Form::VALID)
			->addRule(Form::FILLED, $this->translator->translate("messages.registerForm.passAgainPlease"))
			->addRule(Form::EQUAL, $this->translator->translate("messages.registerForm.passMatch"), $form['password']);
		$form->addText('email', 'E-mail: *', 35)
			->setEmptyValue('@')
			->setAttribute('class', 'form-control')
			->addRule(Form::FILLED, $this->translator->translate("messages.registerForm.enterEmail"))
			->addCondition(Form::FILLED)
			->addRule(Form::EMAIL, $this->translator->translate("messages.registerForm.invalidEmail"));
		$form->addSubmit('register', $this->translator->translate("messages.registerForm.register"))
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
			$this->flashMessage($this->translator->translate("messages.registerForm.registerSucc"), 'success');
			$this->redirect('Sign:in');
		}
	}
}