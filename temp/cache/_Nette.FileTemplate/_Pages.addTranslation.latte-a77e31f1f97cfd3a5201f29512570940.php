<?php //netteCache[01]000395a:2:{s:4:"time";s:21:"0.29528100 1387299553";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:73:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\Pages\addTranslation.latte";i:2;i:1387299367;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\Pages\addTranslation.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'hno50w7bqy')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb4f1f868b52_content')) { function _lb4f1f868b52_content($_l, $_args) { extract($_args)
?><div class="col-md-6">
<?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>
	<p></p>
	<p><?php echo $template->texy($translatePage->text) ?></p>	
</div>

<div class="col-md-6">
	<h2><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.translateTo"), ENT_NOQUOTES) ?>:
<?php if ($translatePage->language_code == "en"): ?>
		Slovak
<?php else: ?>
		English
<?php endif ?>
	</h2>
<?php $_ctrl = $_control->getComponent("addTranslationForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
</div>

<a href="<?php echo htmlSpecialChars($_control->link("default")) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.backToManagePages"), ENT_NOQUOTES) ?></a>
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb8e82bdd421_title')) { function _lb8e82bdd421_title($_l, $_args) { extract($_args)
?>	<h2><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.translatePage"), ENT_NOQUOTES) ?>
: <?php echo Nette\Templating\Helpers::escapeHtml($translatePage->title, ENT_NOQUOTES) ?></h2>
<?php
}}

//
// block scripts
//
if (!function_exists($_l->blocks['scripts'][] = '_lbc520fdf0ec_scripts')) { function _lbc520fdf0ec_scripts($_l, $_args) { extract($_args)
?>	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/bootstrap.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.nette.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/live-form-validation.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.ajaxform.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/nextras.datetimepicker.init.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/nextras.netteForms.js"></script>
<?php
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
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['scripts']), $_l, get_defined_vars()) ; 