<?php //netteCache[01]000388a:2:{s:4:"time";s:21:"0.19405900 1386698059";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\Task\notFound.latte";i:2;i:1386698050;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\Task\notFound.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'rghfeo74r8')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb9353ab8dfe_content')) { function _lb9353ab8dfe_content($_l, $_args) { extract($_args)
;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<p><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.task.notFoundExplan"), ENT_NOQUOTES) ?></p>

<a href="<?php echo htmlSpecialChars($_control->link("default:")) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.actions.backToAdmin"), ENT_NOQUOTES) ?>
</a><?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb2f8d11c1a9_title')) { function _lb2f8d11c1a9_title($_l, $_args) { extract($_args)
?><h1><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.task.listNotFound"), ENT_NOQUOTES) ?></h1>
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
$netteHttpResponse->setCode(404) ?>


<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 