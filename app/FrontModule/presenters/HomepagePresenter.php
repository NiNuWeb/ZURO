<?php

namespace FrontModule;

use Nette\Application\BadRequestException,
	Nette\Application\UI\Form as Form,
	Nette\Application\UI,
	Nette\Security\AuthenticationException,
	Nette\Diagnostics\Debugger;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
	/**	@var Nette\Database\Table\Selection */
	public $pages;

	/** @var \Main\NewsRepository */
	public $newsRepository;

	/** @var Nette\Database\Table\Selection */
	private $page;

	/** @var Nette\Database\Table\Selection */
	private $menu;

	/**
	 * Inject repozirátov
	 *
	 */
	public function injectRepository(\Main\PagesRepository $pagesRepository, \Main\NewsRepository $newsRepository) {
		$this->pages = $pagesRepository;
		$this->newsRepository = $newsRepository;
	}


	/**
	 * Vytiahne a nastaví $page a $menu
	 * @param string $slug
	 */
	public function actionPage($slug = NULL) {

		if (is_null($slug)) {
			$slug = $this->pages->findFirstPage()->slug; //vracia prvý záznam z tabuľky pages
		}

		$this->page = $this->pages->findBySlug($slug);
		$this->menu = $this->pages->getMenu();

		if (!$this->page) {
			throw new BadRequestException('Stránka sa nenašla!', 404);
		}
	}

	/**
	 * Mini Login form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentMiniLoginForm() {
		$form = new Form;
		$form->elementPrototype->addAttributes(array('class' => 'form-horizontal col-lg-7 pull-right'));
		$renderer = $form->getRenderer();

		
		$renderer->wrappers['control']['.submit'] = 'btn';

		$form->addText('username', '')
			->setAttribute('class', 'form-control input-sm')
			->setAttribute('placeholder', 'Username')
			->addRule(Form::FILLED, 'Please enter username.');
		$form->addPassword('password', '')
			->setAttribute('class', 'form-control input-sm')
			->setAttribute('placeholder', 'Password')
			->addRule(Form::FILLED, 'Please enter password');
		$form->addSubmit('login', 'Login')
			->setAttribute('class', 'btn-sm btn-primary pull-left');	
		$form->addSubmit('register', 'Registration')
			->setValidationScope(FALSE)
			->setAttribute('class', 'btn-sm btn-link pull-right')
			->onClick[] = $this->redirectToRegistration;	
		$form->onSuccess[] = callback($this, 'MiniLoginFormSucceeded');
		return $form;		
	}

	/**
	 * Presmerovanie na registračný formulár z MiniLogin formulára
	 */
	public function redirectToRegistration($button) {
		$this->redirect('Register:register');
	}

	/**
	 * Úspešné odoslanie validného MiniLoginForm-u
	 */
	public function MiniLoginFormSucceeded(Form $form) {
		$values = $form->getValues();

		try {
			$this->getUser()->login($values->username, $values->password);
			$this->redirect('Homepage:page');

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	/**
	 * Render pre Page
	 * @param string $slug
	 */
	public function renderPage($slug = NULL) {
		if (is_null($slug)) {
			$slug = $this->pages->findFirstPage()->slug; // Vyberie prvý záznam z tabuľky pages
		}

		$vp = new \VisualPaginator($this, 'vp');
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 3;
		$paginator->itemCount = $this->newsRepository->countAll();

		$this->template->page = $this->page;

		$this->template->menu = $this->menu;

		$this->template->news = $this->newsRepository->getAllNews()->limit($paginator->itemsPerPage, $paginator->offset);

	}


	/**
	 * Odhlásenie usera
	 */
	public function handleLogout() {
		$this->user->logOut();
		$this->flashMessage('You Were Logged Off.');
		$this->redirect('this');
	}

}
