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
			$slug = $this->pages->findFirstPage($this->translator->getLocale())->slug; //vracia prvý záznam z tabuľky pages
		}

		$this->page = $this->pages->findBySlug($slug, $this->translator->getLocale());
		//$this->menu = $this->pages->getMenu($this->translator->getLocale());

		if (!$this->page) {
			throw new BadRequestException($this->translator->translate("messages.requests.404"), 404);
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

		$form->addText('username', NULL)
			->setAttribute('class', 'form-control input-sm')
			->setAttribute('placeholder', $this->translator->translate("messages.miniLoginForm.username"))
			->addRule(Form::FILLED, $this->translator->translate("messages.miniLoginForm.enterusername"));
		$form->addPassword('password', NULL)
			->setAttribute('class', 'form-control input-sm')
			->setAttribute('placeholder', $this->translator->translate("messages.miniLoginForm.password"))
			->addRule(Form::FILLED, $this->translator->translate("messages.miniLoginForm.enterpassword"));
		$form->addSubmit('login', $this->translator->translate("messages.miniLoginForm.login"))
			->setAttribute('class', 'btn-sm btn-primary pull-left');	
		$form->addSubmit('register', $this->translator->translate("messages.miniLoginForm.registration"))
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
			$slug = $this->pages->findFirstPage($this->translator->getLocale())->slug; // Vyberie prvý záznam z tabuľky pages
		}

		$vp = new \VisualPaginator($this, 'vp');
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 3;
		$paginator->itemCount = $this->newsRepository->countAll();

		$this->template->page = $this->page;

		$this->template->menu = $this->pages->getMenu($this->translator->getLocale());

		$this->template->news = $this->newsRepository->getAllNews($this->translator->getLocale())->limit($paginator->itemsPerPage, $paginator->offset);

	}


	/**
	 * Odhlásenie usera
	 */
	public function handleLogout() {
		$this->user->logOut();
		$this->flashMessage($this->translator->translate("messages.actions.logoff"));
		$this->redirect('this');
	}

}
