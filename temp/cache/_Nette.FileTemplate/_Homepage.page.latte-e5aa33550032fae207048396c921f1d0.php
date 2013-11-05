<?php //netteCache[01]000388a:2:{s:4:"time";s:21:"0.46627900 1382796153";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"C:\xampp\htdocs\ZURO\app\FrontModule\templates\Homepage\page.latte";i:2;i:1382796151;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\FrontModule\templates\Homepage\page.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '19whlz59ba')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block MiniLogin
//
if (!function_exists($_l->blocks['MiniLogin'][] = '_lbeabe7098fb_MiniLogin')) { function _lbeabe7098fb_MiniLogin($_l, $_args) { extract($_args)
;if ($user->isLoggedIn()): ?>
		<div class="pull-right col-lg-7">
			<p><b>Logged As:</b> <?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->username, ENT_NOQUOTES) ?></p>
			<p><b>Permission:</b> <?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->role, ENT_NOQUOTES) ?></p>
			<p><a class="btn btn-info btn-sm pull-left" href="<?php echo htmlSpecialChars($_control->link("logout!")) ?>
">Log out</a></p>
<?php if ($user->isAllowed('Admin:Default')): ?>
				<a class="btn btn-danger btn-sm pull-right" href="<?php echo htmlSpecialChars($_control->link(":Admin:Default:")) ?>
">Administration</a>
<?php endif ?>
		</div>
<?php else: $_ctrl = $_control->getComponent("miniLoginForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb17cad5f339_content')) { function _lb17cad5f339_content($_l, $_args) { extract($_args)
;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>
<p><?php echo $page->text ?></p><?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb7edbd688f0_title')) { function _lb7edbd688f0_title($_l, $_args) { extract($_args)
?><h2><?php echo Nette\Templating\Helpers::escapeHtml($page->title, ENT_NOQUOTES) ?></h2>
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
call_user_func(reset($_l->blocks['MiniLogin']), $_l, get_defined_vars())  ?>


<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 