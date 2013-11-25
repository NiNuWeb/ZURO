<?php //netteCache[01]000386a:2:{s:4:"time";s:21:"0.65564100 1385369951";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:64:"C:\xampp\htdocs\ZURO\app\FrontModule\templates\News\single.latte";i:2;i:1385369949;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\FrontModule\templates\News\single.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'tnkkml6zkk')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb9beed29629_content')) { function _lb9beed29629_content($_l, $_args) { extract($_args)
;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>
<small>Added by: <?php echo Nette\Templating\Helpers::escapeHtml($singleNews->users->username, ENT_NOQUOTES) ?>
 - <?php echo Nette\Templating\Helpers::escapeHtml($template->date($singleNews->date, 'j.n.Y H:i:s'), ENT_NOQUOTES) ?></small>
<p></p>
<p><?php echo $template->texy($singleNews->body) ?></p>
<a class="btn btn-primary" href="<?php echo htmlSpecialChars($_control->link(":Front:Homepage:page")) ?>
"> << Back</a>
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbf1342c6242_title')) { function _lbf1342c6242_title($_l, $_args) { extract($_args)
?><h3><?php echo Nette\Templating\Helpers::escapeHtml($singleNews->title, ENT_NOQUOTES) ?></h3>
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