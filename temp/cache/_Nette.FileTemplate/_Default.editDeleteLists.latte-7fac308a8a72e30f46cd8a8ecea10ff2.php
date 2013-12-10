<?php //netteCache[01]000398a:2:{s:4:"time";s:21:"0.22075700 1386602791";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:76:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\Default\editDeleteLists.latte";i:2;i:1386602783;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\Default\editDeleteLists.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'prcsfdqxw4')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb9b775924d8_content')) { function _lb9b775924d8_content($_l, $_args) { extract($_args)
?><h1><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.edLists"), ENT_NOQUOTES) ?></h1>

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

		<h3><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.edLists"), ENT_NOQUOTES) ?></h3>
		<small><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.warningLists"), ENT_NOQUOTES) ?></small>
<div id="<?php echo $_control->getSnippetId('tableLists') ?>"><?php call_user_func(reset($_l->blocks['_tableLists']), $_l, $template->getParameters()) ?>
</div>	</div>

</div> <!-- End Row --><?php
}}

//
// block _tableLists
//
if (!function_exists($_l->blocks['_tableLists'][] = '_lb466fa2bc5d__tableLists')) { function _lb466fa2bc5d__tableLists($_l, $_args) { extract($_args); $_control->validateControl('tableLists')
?>		<table class="lists table table-striped">
			<thead class="todo">
				<tr>
					<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.title"), ENT_NOQUOTES) ?></th>
					<th class="action"><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.action"), ENT_NOQUOTES) ?></th>
				</tr>	
			</thead>
			<tbody>
<?php $iterations = 0; foreach ($lists as $list): ?>
				<tr>
					<td class="title"><?php echo Nette\Templating\Helpers::escapeHtml($list->title, ENT_NOQUOTES) ?></td>	
					<td class="action"><a href="<?php echo htmlSpecialChars($_control->link("Default:editList", array($list->id))) ?>
"><i class="glyphicon glyphicon-pencil">&nbsp;</i><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.default.edit"), ENT_NOQUOTES) ?>
</a> | <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("deleteList!", array($list->id))) ?>
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