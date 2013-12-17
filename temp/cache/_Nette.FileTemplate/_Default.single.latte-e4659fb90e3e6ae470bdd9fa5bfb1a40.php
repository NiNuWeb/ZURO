<?php //netteCache[01]000389a:2:{s:4:"time";s:21:"0.73331000 1387019145";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:67:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\Default\single.latte";i:2;i:1387019143;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\Default\single.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'ewxrn81oo5')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbc79861962e_content')) { function _lbc79861962e_content($_l, $_args) { extract($_args)
;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>
<small>Added By: <?php echo Nette\Templating\Helpers::escapeHtml($myNews->news->users->username, ENT_NOQUOTES) ?>
 on <?php echo Nette\Templating\Helpers::escapeHtml($myNews->news->date, ENT_NOQUOTES) ?></small>
<p></p>
<p><?php echo Nette\Templating\Helpers::escapeHtml($myNews->body, ENT_NOQUOTES) ?></p>
<p>Language: <?php echo Nette\Templating\Helpers::escapeHtml($myNews->language->name, ENT_NOQUOTES) ?></p>	
<p>Language Code: <?php echo Nette\Templating\Helpers::escapeHtml($myNews->language->code, ENT_NOQUOTES) ?></p>	
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb0e75cb909b_title')) { function _lb0e75cb909b_title($_l, $_args) { extract($_args)
?><h3><?php echo Nette\Templating\Helpers::escapeHtml($myNews->title, ENT_NOQUOTES) ?></h3>
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
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 