<?php //netteCache[01]000388a:2:{s:4:"time";s:21:"0.31329600 1387031007";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"C:\xampp\htdocs\ZURO\app\FrontModule\templates\Homepage\page.latte";i:2;i:1387030996;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\FrontModule\templates\Homepage\page.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'qi1dnix3o0')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block MiniLogin
//
if (!function_exists($_l->blocks['MiniLogin'][] = '_lb57c8dd0027_MiniLogin')) { function _lb57c8dd0027_MiniLogin($_l, $_args) { extract($_args)
;if ($user->isLoggedIn()): ?>
		<div class="pull-right col-lg-7">
			<p><b><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.miniLoginForm.logged_as"), ENT_NOQUOTES) ?>
:</b> <?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->username, ENT_NOQUOTES) ?></p>
			<p><b><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.miniLoginForm.permission"), ENT_NOQUOTES) ?>
:</b> <?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->role, ENT_NOQUOTES) ?></p>
			<p><a class="btn btn-info btn-sm pull-left" href="<?php echo htmlSpecialChars($_control->link("logout!")) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.miniLoginForm.logout"), ENT_NOQUOTES) ?></a></p>
<?php if ($user->isAllowed('Admin:Default')): ?>
				<a class="btn btn-danger btn-sm pull-right" href="<?php echo htmlSpecialChars($_control->link(":Admin:Default:")) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.miniLoginForm.administration"), ENT_NOQUOTES) ?></a>
<?php endif ?>
		</div>
<?php else: $_ctrl = $_control->getComponent("miniLoginForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb8f0da6ef3e_content')) { function _lb8f0da6ef3e_content($_l, $_args) { extract($_args)
;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>
<p><?php echo $template->texy($page->text) ?></p>

<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb995c1cf279_title')) { function _lb995c1cf279_title($_l, $_args) { extract($_args)
?><h2><?php echo Nette\Templating\Helpers::escapeHtml($page->title, ENT_NOQUOTES) ?></h2>
<?php
}}

//
// block news
//
if (!function_exists($_l->blocks['news'][] = '_lbbdc2e071ef_news')) { function _lbbdc2e071ef_news($_l, $_args) { extract($_args)
;if (count($news)): ?>
		<div id="news">
			<div class="container well">
				<h2><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.page.news"), ENT_NOQUOTES) ?></h2>
				<div class="row">
<?php $iterations = 0; foreach ($news as $new): ?>
						<div class="col-md-4">
							<div class="new">
								<div class="news-header">
									<h3><?php echo Nette\Templating\Helpers::escapeHtml($new->title, ENT_NOQUOTES) ?></h3>
									<small><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.news.addedBy"), ENT_NOQUOTES) ?>
: <?php echo Nette\Templating\Helpers::escapeHtml($new->news->users->username, ENT_NOQUOTES) ?>
 - <?php echo Nette\Templating\Helpers::escapeHtml($template->date($new->news->date, 'j.n.Y H:i:s'), ENT_NOQUOTES) ?></small>
								</div>
								<p></p>
								<p><?php echo $template->striptags($template->texy($template->truncate($new->body, 310))) ?></p>
								<a class="btn btn-primary" href="<?php echo htmlSpecialChars($_control->link("News:single", array($new->news_id))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.news.readMore"), ENT_NOQUOTES) ?></a>
							</div>
						</div>
<?php $iterations++; endforeach ;$_ctrl = $_control->getComponent("vp"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
				</div>
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
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['MiniLogin']), $_l, get_defined_vars())  ?>


<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['news']), $_l, get_defined_vars()) ; 