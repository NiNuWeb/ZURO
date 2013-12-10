<?php

namespace AdminModule;

use Nette\Security\User;

abstract class BasePresenter extends \BasePresenter {


	public function startup() {

		parent::startup();

		if ($this->name != 'Admin:Auth') {
			if (!$this->user->isLoggedIn()) {
				if ($this->user->getLogoutReason() === User::INACTIVITY) {
					$this->flashMessage('Session timeout, you have been logged out');
				}

				$this->redirect('Auth:login', array(
					'backlink' => $this->storeRequest()
				));

			} else {
				if (!$this->user->isAllowed($this->name, $this->action)) {
					$this->flashMessage($this->translator->translate('messages.actions.accessDenied'), 'warning');
					$this->redirect('Default:');
				}
			}
		}
	} // End Startup


	/**
	 * Logout User
	 */
	public function handleLogout() {
		$this->user->logOut();
		$this->flashMessage($this->translator->translate('messages.actions.logoff'));
		$this->redirect(':Front:Homepage:page', array(
			'backlink' => NULL
		));
	}


}