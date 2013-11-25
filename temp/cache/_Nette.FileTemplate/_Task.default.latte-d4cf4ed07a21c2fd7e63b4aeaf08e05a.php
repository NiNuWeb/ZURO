<?php //netteCache[01]000387a:2:{s:4:"time";s:21:"0.49053900 1384866147";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:65:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\Task\default.latte";i:2;i:1383912109;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\Task\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'l79c1fycba')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbcd46d1b47e_content')) { function _lbcd46d1b47e_content($_l, $_args) { extract($_args)
?><div class="row">

	<div class="col-md-2 right-border">
		<div id="sidebar">
			<h3>Lists Category</h3>
			<div class="task-list">
				<ul>
<?php $iterations = 0; foreach ($lists as $listum): ?>					<li><a href="<?php echo htmlSpecialChars($_control->link("Task:", array($listum->id))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($listum->title, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; endforeach ?>
				</ul>
			</div>		
		</div>
	</div>

	<div class="col-md-6">
<?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<?php $_ctrl = $_control->getComponent("taskList"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>

<div id="<?php echo $_control->getSnippetId('form') ?>"><?php call_user_func(reset($_l->blocks['_form']), $_l, $template->getParameters()) ?>
</div>
	</div>

</div> <!-- End Row -->

<a href="<?php echo htmlSpecialChars($_control->link("default:")) ?>">Back to Admin Homepage</a>

<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb57a26ce748_title')) { function _lb57a26ce748_title($_l, $_args) { extract($_args)
?>		<h2><?php echo Nette\Templating\Helpers::escapeHtml($list->title, ENT_NOQUOTES) ?></h2>
<?php
}}

//
// block _form
//
if (!function_exists($_l->blocks['_form'][] = '_lb4dc33cb430__form')) { function _lb4dc33cb430__form($_l, $_args) { extract($_args); $_control->validateControl('form')
?>			<fieldset id="newTask">
				<legend>Add New Task</legend>
<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("taskForm") ? "taskForm" : $_control["taskForm"]), array('class' => 'ajax')) ?>
					<div class="task-form">
<?php if (is_object($form)) $_ctrl = $form; else $_ctrl = $_control->getComponent($form); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render('errors') ?>

					    <?php $_input = is_object("text") ? "text" : $_form["text"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?>
 <?php $_input = (is_object("text") ? "text" : $_form["text"]); echo $_input->getControl()->addAttributes(array('size' => 30, 'autofocus' => true)) ?>
 <?php $_input = is_object("userId") ? "userId" : $_form["userId"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?>
 <?php $_input = (is_object("userId") ? "userId" : $_form["userId"]); echo $_input->getControl()->addAttributes(array()) ?>
 <?php $_input = (is_object("create") ? "create" : $_form["create"]); echo $_input->getControl()->addAttributes(array()) ?>

					</div>
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ?>
			</fieldset>
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

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 