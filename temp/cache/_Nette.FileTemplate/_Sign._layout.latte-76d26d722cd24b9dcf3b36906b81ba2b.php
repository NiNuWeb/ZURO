<?php //netteCache[01]000387a:2:{s:4:"time";s:21:"0.92650800 1382630306";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:65:"C:\xampp\htdocs\ZURO\app\FrontModule\templates\Sign\@layout.latte";i:2;i:1382629257;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\FrontModule\templates\Sign\@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'j3zf3f52nt')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lba46bf6c6f3_title')) { function _lba46bf6c6f3_title($_l, $_args) { extract($_args)
?>ZURO App<?php
}}

//
// block scripts
//
if (!function_exists($_l->blocks['scripts'][] = '_lb67d0d53fb0_scripts')) { function _lb67d0d53fb0_scripts($_l, $_args) { extract($_args)
?>	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/bootstrap.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/netteForms.js"></script>
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
ob_start(); call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()); echo $template->upper($template->striptags(ob_get_clean()))  ?></title>

	<!-- <link rel="stylesheet" media="screen,projection,tv" href="<?php echo Nette\Templating\Helpers::escapeHtmlComment($basePath) ?>/css/screen.css">
	<link rel="stylesheet" media="print" href="<?php echo Nette\Templating\Helpers::escapeHtmlComment($basePath) ?>/css/print.css"> -->
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/zuro.css" />
	<link rel="shortcut icon" href="<?php echo htmlSpecialChars($basePath) ?>/favicon.ico" />
</head>

<body>
	<script> document.documentElement.className+=' js' </script>

	<div id="header">
		<div class="container header-bg well">
			<div class="row">
				<div class="col-md-8">
					<h1 class="header-a"><a href="<?php echo htmlSpecialChars($_control->link("Homepage:page")) ?>
"><b>ZURO</b> Development</a><img src="<?php echo htmlSpecialChars($basePath) ?>/images/header-img.jpg" /></h1>
				</div>
				<div class="col-md-4">
					<form action="" class="form-inline pull-right">
						<input type="text" class="span3" placeholder="Username..." />
						<input type="text" class="span3" placeholder="Password..." />
						<input type="submit" class="btn btn-primary" value="Login" />
					</form>
					<a class="pull-right" href="<?php echo htmlSpecialChars($_control->link("Register:register")) ?>
">Registration</a>
				</div>
			</div>
		</div>
	</div>

<?php $iterations = 0; foreach ($flashes as $flash): ?>	<div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ?>

<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ?>

	<div id="footer">
		<div class="container well">
		<p>Copyright (c) 2013</p>
		</div>
	</div>

<?php call_user_func(reset($_l->blocks['scripts']), $_l, get_defined_vars())  ?>
</body>
</html>
