<?php //netteCache[01]000382a:2:{s:4:"time";s:21:"0.20181200 1384538652";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:60:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\@layout.latte";i:2;i:1384538649;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'x1ovsivxhe')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb89522d3837_title')) { function _lb89522d3837_title($_l, $_args) { extract($_args)
?>Admin | ZURO App<?php
}}

//
// block _flashMessages
//
if (!function_exists($_l->blocks['_flashMessages'][] = '_lbee1cbeb3ab__flashMessages')) { function _lbee1cbeb3ab__flashMessages($_l, $_args) { extract($_args); $_control->validateControl('flashMessages')
;$iterations = 0; foreach ($flashes as $flash): ?>		<div class="flash <?php echo htmlSpecialChars($flash->type) ?> ajax">
			<p><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></p>
		</div>
<?php $iterations++; endforeach ;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lba0b18cddce_content')) { function _lba0b18cddce_content($_l, $_args) { extract($_args)
?>		
<?php
}}

//
// block scripts
//
if (!function_exists($_l->blocks['scripts'][] = '_lb113ff27337_scripts')) { function _lb113ff27337_scripts($_l, $_args) { extract($_args)
?>	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/bootstrap.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/netteForms.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.nette.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/main.js"></script>
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
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="description" content="" />
<?php if (isset($robots)): ?>	<meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>" />
<?php endif ?>

	<title><?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
ob_start(); call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()); echo $template->upper($template->strip($template->stripTags(ob_get_clean())))  ?></title>

	<!-- <link rel="stylesheet" media="screen,projection,tv" href="<?php echo Nette\Templating\Helpers::escapeHtmlComment($basePath) ?>/css/screen.css">
	<link rel="stylesheet" media="print" href="<?php echo Nette\Templating\Helpers::escapeHtmlComment($basePath) ?>/css/print.css"> -->
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/zuro.css" />
	<link rel="shortcut icon" href="<?php echo htmlSpecialChars($basePath) ?>/favicon.ico" />
</head>

<body>
	<script> document.documentElement.className+=' js' </script>

<?php if ($user->isLoggedIn()): ?>
<div id="header">
	<div class="navbar navbar-default-admin navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="glyphicon glyphicon-list"></span>
				</button>
				<a class="navbar-brand" href="<?php echo htmlSpecialChars($_control->link("default:")) ?>
">ZURO Development | Administration</a>
			</div>
			
			<div class="navbar-collapse collapse">
				<ul class="admin-nav nav navbar-nav">
					<li><a href="<?php echo htmlSpecialChars($_control->link("Users:default")) ?>
"><i class="glyphicon glyphicon-user">&nbsp;</i>Manage Users</a></li>
					<li><a href="<?php echo htmlSpecialChars($_control->link("Pages:default")) ?>
"><i class="glyphicon glyphicon-file">&nbsp;</i>Manage Pages</a></li>
					<li><a href="<?php echo htmlSpecialChars($_control->link("News:default")) ?>
"><i class="glyphicon glyphicon-globe">&nbsp;</i>Manage News</a></li>
					<li><a href="<?php echo htmlSpecialChars($_control->link("logout!")) ?>"><i class="glyphicon glyphicon-off">&nbsp;</i><?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->username, ENT_NOQUOTES) ?> - Logout</a></li>
				</ul>
			</div>	
		</div>
	</div>
</div>
<?php endif ?>
<div id="admincontent">
	<div class="container well2">
		<a href="<?php echo htmlSpecialChars($_control->link(":Front:Homepage:page")) ?>
">Back To Front Homepage</a>

<div id="<?php echo $_control->getSnippetId('flashMessages') ?>"><?php call_user_func(reset($_l->blocks['_flashMessages']), $_l, $template->getParameters()) ?>
</div>
<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>

	</div>
</div>	
<?php call_user_func(reset($_l->blocks['scripts']), $_l, get_defined_vars())  ?>
</body>
</html>
