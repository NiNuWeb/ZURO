<?php //netteCache[01]000382a:2:{s:4:"time";s:21:"0.43314000 1384945023";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:60:"C:\xampp\htdocs\ZURO\app\components\confirmationDialog.latte";i:2;i:1384945021;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\components\confirmationDialog.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'jou0bsih39')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block _
//
if (!function_exists($_l->blocks['_'][] = '_lb179c1fdd4d__')) { function _lb179c1fdd4d__($_l, $_args) { extract($_args); $_control->validateControl(false)
;if ($visible): ?>
		<div class="overlay <?php echo htmlSpecialChars($class) ?>--overlay"></div>
		<div class="<?php echo htmlSpecialChars($class) ?> modal-content">
			<div class="modal-body">
				<?php echo Nette\Templating\Helpers::escapeHtml($question, ENT_NOQUOTES) ?>

			</div>
			<div class="modal-footer">
<?php $_ctrl = $_control->getComponent("form"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
			</div>
		</div>
<?php endif ;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); } ?>
<div id="<?php echo $_control->getSnippetId('') ?>"><?php call_user_func(reset($_l->blocks['_']), $_l, $template->getParameters()) ?>
</div>