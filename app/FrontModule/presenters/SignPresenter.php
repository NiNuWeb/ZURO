<?php

namespace FrontModule;

use Nette\Application\UI;


/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{

	public function beforeRender() {
		$this->setLayout('registration');
	}

	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = new UI\Form;
		$form->elementPrototype->addAttributes(array('class' => 'form-horizontal col-lg-3'));
		$renderer = $form->getRenderer();

		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = 'div class="form-group"';
		$renderer->wrappers['control']['.submit'] = 'btn';

		$form->addText('username', $this->translator->translate("messages.signInForm.username").':')
			->setAttribute('class', 'form-control')
			->setRequired($this->translator->translate("messages.signInForm.enterusername"));

		$form->addPassword('password', $this->translator->translate("messages.signInForm.password").':')
			->setAttribute('class', 'form-control')
			->setRequired($this->translator->translate("messages.signInForm.enterpassword"));

		$form->addCheckbox('remember', $this->translator->translate("messages.signInForm.keepSigned"));

		$form->addSubmit('send', $this->translator->translate("messages.signInForm.signIn"))
			->setAttribute('class', 'btn-info pull-left');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}


	public function signInFormSucceeded($form)
	{
		$values = $form->getValues();

		if ($values->remember) {
			$this->getUser()->setExpiration('14 days', FALSE);
		} else {
			$this->getUser()->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->username, $values->password);
			$this->redirect('Homepage:page');

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage($this->translator->translate("messages.signInForm.logOut"));
		$this->redirect('in');
	}

}
