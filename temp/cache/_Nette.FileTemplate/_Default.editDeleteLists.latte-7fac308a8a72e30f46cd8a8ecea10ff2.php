<?php //netteCache[01]000398a:2:{s:4:"time";s:21:"0.12929700 1386235086";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:76:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\Default\editDeleteLists.latte";i:2;i:1386235070;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\Default\editDeleteLists.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '93cid4flbn')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb6b960aecd9_content')) { function _lb6b960aecd9_content($_l, $_args) { extract($_args)
?><h1>Edit/Delete Lists</h1>

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

		<h3>Edit/Delete Lists</h3>
		<small>WARNING! If you delete list, all tasks belongs to this list will be deleted too!</small>
<div id="<?php echo $_control->getSnippetId('tableLists') ?>"><?php call_user_func(reset($_l->blocks['_tableLists']), $_l, $template->getParameters()) ?>
</div>	</div>

</div> <!-- End Row --><?php
}}

//
// block _tableLists
//
if (!function_exists($_l->blocks['_tableLists'][] = '_lb95568245e1__tableLists')) { function _lb95568245e1__tableLists($_l, $_args) { extract($_args); $_control->validateControl('tableLists')
?>		<table class="lists table table-striped">
			<thead class="todo">
				<tr>
					<th>Title</th>
					<th class="action">Action</th>
				</tr>	
			</thead>
			<tbody>
<?php $iterations = 0; foreach ($lists as $list): ?>
				<tr>
					<td class="title"><?php echo Nette\Templating\Helpers::escapeHtml($list->title, ENT_NOQUOTES) ?></td>	
					<td class="action"><a href="<?php echo htmlSpecialChars($_control->link("Default:editList", array($list->id))) ?>
"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</a> | <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("deleteList!", array($list->id))) ?>
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