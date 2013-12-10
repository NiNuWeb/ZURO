<?php //netteCache[01]000398a:2:{s:4:"time";s:21:"0.63562500 1386602988";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:76:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\Default\editDeleteTasks.latte";i:2;i:1386602986;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\Default\editDeleteTasks.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'czamqprw5r')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb355eaea730_content')) { function _lb355eaea730_content($_l, $_args) { extract($_args)
?><h1><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.edTasks"), ENT_NOQUOTES) ?></h1>

<div class="row">

	<div class="col-md-2 right-border">
		<div id="sidebar">
			<h3><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.listsCat"), ENT_NOQUOTES) ?></h3>

			<div class="task-list">
				<ul>
<?php $iterations = 0; foreach ($lists as $list): ?>					<li><a href="<?php echo htmlSpecialChars($_control->link("Task:", array($list->id))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($list->title, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; endforeach ?>
				</ul>
			</div>

			<div id="new-list">
				<h4><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.addList"), ENT_NOQUOTES) ?></h4>
<?php $_ctrl = $_control->getComponent("newListForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
			</div>

		<p>&nbsp;</p>	
		<a href="<?php echo htmlSpecialChars($_control->link("default:")) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.backToAdminFront"), ENT_NOQUOTES) ?></a>

		</div>
	</div>

	<div class="col-md-6">

		<h3><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.edTasks"), ENT_NOQUOTES) ?></h3>
<div id="<?php echo $_control->getSnippetId('tableTasks') ?>"><?php call_user_func(reset($_l->blocks['_tableTasks']), $_l, $template->getParameters()) ?>
</div>	</div>

</div> <!-- End Row --><?php
}}

//
// block _tableTasks
//
if (!function_exists($_l->blocks['_tableTasks'][] = '_lbe539f6add3__tableTasks')) { function _lbe539f6add3__tableTasks($_l, $_args) { extract($_args); $_control->validateControl('tableTasks')
?>		<table class="tasks table table-striped">
			<thead class="todo">
				<tr>
					<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.text"), ENT_NOQUOTES) ?></th>
					<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.done"), ENT_NOQUOTES) ?></th>
					<th class="for-user"><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.forUser"), ENT_NOQUOTES) ?></th>
					<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.inList"), ENT_NOQUOTES) ?></th>
					<th class="big-action"><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.action"), ENT_NOQUOTES) ?></th>
				</tr>	
			</thead>
			<tbody>
<?php $iterations = 0; foreach ($tasks as $task): ?>
				<tr>
					<td><?php echo Nette\Templating\Helpers::escapeHtml($template->truncate($task->text, 20), ENT_NOQUOTES) ?></td>	
					<td><?php echo Nette\Templating\Helpers::escapeHtml($task->done ? 'yes' : 'no', ENT_NOQUOTES) ?></td>	
					<td><?php echo Nette\Templating\Helpers::escapeHtml($task->users->username, ENT_NOQUOTES) ?></td>	
					<td><?php echo Nette\Templating\Helpers::escapeHtml($task->list->title, ENT_NOQUOTES) ?></td>
					<td class="big-action"><a href="<?php echo htmlSpecialChars($_control->link("Default:editTask", array($task->id))) ?>
"><i class="glyphicon glyphicon-pencil">&nbsp;</i><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.edit"), ENT_NOQUOTES) ?>
</a> | <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("deleteTask!", array($task->id))) ?>
"><i class="glyphicon glyphicon-trash">&nbsp;</i><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.delete"), ENT_NOQUOTES) ?></a></td>
				</tr>
<?php $iterations++; endforeach ?>
			</tbody>
		</table>
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