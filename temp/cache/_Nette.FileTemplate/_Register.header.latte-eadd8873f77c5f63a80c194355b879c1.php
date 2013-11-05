<?php //netteCache[01]000390a:2:{s:4:"time";s:21:"0.64680100 1381997184";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:68:"C:\xampp\htdocs\ZURO\app\FrontModule\templates\Register\header.latte";i:2;i:1381997163;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\FrontModule\templates\Register\header.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'dwfzujx0mg')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block header
//
if (!function_exists($_l->blocks['header'][] = '_lb7f42999e36_header')) { function _lb7f42999e36_header($_l, $_args) { extract($_args)
?>	<div class="container header-bg well">
		<div class="row">
			<div class="col-md-8">
				<h1><b>ZURO</b> Development <img src="images/header-img.jpg" /></h1>
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
					<li><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">CodeIgniter</a></li>
							<li><a href="#">Nette Framework</a></li>
							<li><a href="#">Symphony2</a></li>
						</ul>
					</li>
					<li><a href="#">Contact</a></li>
				</ul>	
			</div>

		</div>
	</div>

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
call_user_func(reset($_l->blocks['header']), $_l, get_defined_vars())  ?>
<!-- ============End Header================== -->