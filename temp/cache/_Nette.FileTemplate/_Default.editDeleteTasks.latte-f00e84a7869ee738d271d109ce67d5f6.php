<?php //netteCache[01]000398a:2:{s:4:"time";s:21:"0.66102700 1384348651";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:76:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\Default\editDeleteTasks.latte";i:2;i:1384348642;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\Default\editDeleteTasks.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '8hncbigi7x')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbce1fee53ea_content')) { function _lbce1fee53ea_content($_l, $_args) { extract($_args)
?><h1>Edit/Delete Tasks</h1>

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

		<p>&nbsp;</p>	
		<a href="<?php echo htmlSpecialChars($_control->link("default:")) ?>">Back to Admin Homepage</a>

		</div>
	</div>

	<div class="col-md-6">

		<h3>Edit/Delete Tasks</h3>
<div id="<?php echo $_control->getSnippetId('tableTasks') ?>"><?php call_user_func(reset($_l->blocks['_tableTasks']), $_l, $template->getParameters()) ?>
</div>	</div>

</div> <!-- End Row --><?php
}}

//
// block _tableTasks
//
if (!function_exists($_l->blocks['_tableTasks'][] = '_lb4c71876679__tableTasks')) { function _lb4c71876679__tableTasks($_l, $_args) { extract($_args); $_control->validateControl('tableTasks')
?>		<table class="tasks table table-striped">
			<thead class="todo">
				<tr>
					<th>Text</th>
					<th>Done</th>
					<th class="for-user">For User</th>
					<th>In List</th>
					<th class="big-action">Action</th>
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
"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</a> | <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("deleteTask!", array($task->id))) ?>
"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</a></td>
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