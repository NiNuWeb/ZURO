<?php


abstract class BasePresenter extends Nette\Application\UI\Presenter {

	/** @var Texy */
	public $texy;

	/** @persistent */
	public $locale;

	/** @var \Kdyby\Translation\Translator */
	public $translator;

	/*protected function beforeRender()
	{
		$this->template->viewName = $this->view;
		$this->template->root = isset($_SERVER['SCRIPT_FILENAME']) ? realpath(dirname(dirname($_SERVER['SCRIPT_FILENAME']))) : NULL;

		$a = strrpos($this->name, ':');
		if ($a === FALSE) {
			$this->template->moduleName = '';
			$this->template->presenterName = $this->name;
		} else {
			$this->template->moduleName = substr($this->name, 0, $a + 1);
			$this->template->presenterName = substr($this->name, $a + 1);
		}
	}*/

	public function injectTexy(\Texy $texy) {
		$this->texy = $texy;
	}

	public function injectTranslator(\Kdyby\Translation\Translator $translator) {
		$this->translator = $translator;
	}

	public function handleChangeLocale($locale) {
		$this->translator->setLocale($locale);
		$this->redirect('this');
	}

	protected function createTemplate($class = NULL) {
	    $template = parent::createTemplate($class);

	    $template->registerHelper('texy', callback($this->texy, 'process'));
	    $template->registerHelperLoader(callback($this->translator->createTemplateHelpers(), 'loader'));

	    return $template;
	}
	
}
