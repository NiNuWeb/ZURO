<?php //netteCache[01]000382a:2:{s:4:"time";s:21:"0.63771500 1384456628";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:60:"C:\xampp\htdocs\ZURO\app\FrontModule\templates\@layout.latte";i:2;i:1384456626;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\FrontModule\templates\@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'o9r637can3')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb4f700ddd89_title')) { function _lb4f700ddd89_title($_l, $_args) { extract($_args)
?>ZURO App<?php
}}

//
// block MiniLogin
//
if (!function_exists($_l->blocks['MiniLogin'][] = '_lb6ab80f7405_MiniLogin')) { function _lb6ab80f7405_MiniLogin($_l, $_args) { extract($_args)
;
}}

//
// block news
//
if (!function_exists($_l->blocks['news'][] = '_lb94054a24a4_news')) { function _lb94054a24a4_news($_l, $_args) { extract($_args)
;
}}

//
// block scripts
//
if (!function_exists($_l->blocks['scripts'][] = '_lbe58fe78406_scripts')) { function _lbe58fe78406_scripts($_l, $_args) { extract($_args)
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

<body class="front">
	<script> document.documentElement.className+=' js' </script>

	<div id="header">
		<div class="container header-bg well">
			<div class="row">
				<div class="col-md-8">
					<h1 class="header-a"><a href="<?php echo htmlSpecialChars($_control->link("Homepage:page")) ?>
"><b>ZURO</b> Development</a><img src="<?php echo htmlSpecialChars($basePath) ?>/images/header-img.jpg" /></h1>
				</div>
				<div class="col-md-4">
					<?php call_user_func(reset($_l->blocks['MiniLogin']), $_l, get_defined_vars())  ?>

				</div>
			</div>
		</div>
		<div class="container navig">
			<div class="navbar navbar-default">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="navbar-collapse collapse">
					<ul class="nav nav-pills">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($menu) as $slug => $title): ?>						<li>
							<?php if ($iterator->isFirst()): ?><a href="<?php echo htmlSpecialChars($_control->link("this", array('slug' => $slug))) ?>
"<?php if ($_l->tmp = array_filter(array($presenter->linkCurrent ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
>Home</a><?php endif ?>

							<?php if (!$iterator->first): ?><a href="<?php echo htmlSpecialChars($_control->link("this", array('slug' => $slug))) ?>
"<?php if ($_l->tmp = array_filter(array($presenter->linkCurrent ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><?php echo Nette\Templating\Helpers::escapeHtml($title, ENT_NOQUOTES) ?></a><?php endif ?>

						</li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
					</ul>	
				</div>

			</div>
		</div>
	</div>

	<div id="content">
		<div class="container well">
<?php $iterations = 0; foreach ($flashes as $flash): ?>			<div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ;Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
		</div>
	</div>


	<?php call_user_func(reset($_l->blocks['news']), $_l, get_defined_vars())  ?>

	

	<div id="footer">
		<div class="container well">
			<p>Copyright &copy; 2013 | NiNuWeb | <img src="images/nette-powered.gif" alt="Powered by Nette Framework" /></p>
		</div>
	</div>

<?php call_user_func(reset($_l->blocks['scripts']), $_l, get_defined_vars())  ?>
</body>
</html>
