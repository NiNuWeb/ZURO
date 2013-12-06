<?php //netteCache[01]000390a:2:{s:4:"time";s:21:"0.71790000 1386253715";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:68:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\Default\default.latte";i:2;i:1386253695;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\Default\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '8jv4vnx3bw')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbad0d667201_content')) { function _lbad0d667201_content($_l, $_args) { extract($_args)
?><h1>Admin Page</h1>

<div class="row">

	<div class="col-md-2 right-border">
		<div id="sidebar">
			<h3>Lists Category</h3>

			<div class="task-list">
				<ul>
<?php $iterations = 0; foreach ($lists as $list): ?>					<li><a href="<?php echo htmlSpecialChars($_control->link("Task:", array($list->id))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($list->title, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; endforeach ?>
				</ul>
			</div>

			<div id="new-list">
				<h4>Add New List</h4>
<?php $_ctrl = $_control->getComponent("newListForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
			</div>

			<div id="list-task-option">
				<h4>List/Task Options</h4>
				<p><a class="btn btn-danger col-md-12" href="<?php echo htmlSpecialChars($_control->link("Default:editDeleteLists")) ?>
">Edit/Delete Lists</a></p>
				<p><a class="btn btn-danger col-md-12" href="<?php echo htmlSpecialChars($_control->link("Default:editDeleteTasks")) ?>
">Edit/Delete Tasks</a></p>
			</div>

		</div>
	</div>

	<div class="col-md-6">

		<h3>My Incomplete Tasks</h3>
<?php $_ctrl = $_control->getComponent("userTasks"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
		<p>&nbsp;</p>
		<h3>All Incomplete Tasks</h3>
<?php $_ctrl = $_control->getComponent("incompleteTasks"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>

	</div>

	<div class="col-md-4 left-border">
		<h3>Last Added News</h3>
		<br />
<?php $iterations = 0; foreach ($news as $new): ?>
			<p><small class="last-news"><?php echo Nette\Templating\Helpers::escapeHtml($template->date($new->date, 'j.n.Y'), ENT_NOQUOTES) ?>
 - <?php echo Nette\Templating\Helpers::escapeHtml($new->users->username, ENT_NOQUOTES) ?>
</small> | <b><?php echo Nette\Templating\Helpers::escapeHtml($new->title, ENT_NOQUOTES) ?></b></p>
<?php $iterations++; endforeach ?>
	</div>

</div> <!-- End Row --><?php
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