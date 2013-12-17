<?php //netteCache[01]000394a:2:{s:4:"time";s:21:"0.33538000 1387213085";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:72:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\News\addTranslation.latte";i:2;i:1387212999;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\News\addTranslation.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'yez78acml0')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb957611cdd6_content')) { function _lb957611cdd6_content($_l, $_args) { extract($_args)
?><div class="col-md-6">
<?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>
	<small><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.addedBy"), ENT_NOQUOTES) ?>
: <?php echo Nette\Templating\Helpers::escapeHtml($translateNews->news->users->username, ENT_NOQUOTES) ?>
 - <?php echo Nette\Templating\Helpers::escapeHtml($template->date($translateNews->news->date, 'j.n.Y H:i:s'), ENT_NOQUOTES) ?></small>
	<p></p>
	<p><?php echo $template->texy($translateNews->body) ?></p>	
</div>

<div class="col-md-6">
	<h2><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.translateTo"), ENT_NOQUOTES) ?>:
<?php if ($translateNews->language_code == "en"): ?>
		Slovak
<?php else: ?>
		English
<?php endif ?>
	</h2>
<?php $_ctrl = $_control->getComponent("addTranslationForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
</div>

<a href="<?php echo htmlSpecialChars($_control->link("default")) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.backToManageNews"), ENT_NOQUOTES) ?></a>
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb31ddc86d84_title')) { function _lb31ddc86d84_title($_l, $_args) { extract($_args)
?>	<h2><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.translateNews"), ENT_NOQUOTES) ?>
: <?php echo Nette\Templating\Helpers::escapeHtml($translateNews->title, ENT_NOQUOTES) ?></h2>
<?php
}}

//
// block scripts
//
if (!function_exists($_l->blocks['scripts'][] = '_lb402c49d127_scripts')) { function _lb402c49d127_scripts($_l, $_args) { extract($_args)
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