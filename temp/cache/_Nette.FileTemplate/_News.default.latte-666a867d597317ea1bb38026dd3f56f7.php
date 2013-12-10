<?php //netteCache[01]000387a:2:{s:4:"time";s:21:"0.63235600 1386685746";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:65:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\News\default.latte";i:2;i:1386685744;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\News\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'd7lt485xj2')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbe88e603365_content')) { function _lbe88e603365_content($_l, $_args) { extract($_args)
?><h2><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.manageNews"), ENT_NOQUOTES) ?></h2>
<br />
<div class="table-responsive col-md-9">
<div id="<?php echo $_control->getSnippetId('tableNews') ?>"><?php call_user_func(reset($_l->blocks['_tableNews']), $_l, $template->getParameters()) ?>
</div>	<a class="btn btn-danger" href="<?php echo htmlSpecialChars($_control->link("News:AddNews")) ?>
"><i class="glyphicon glyphicon-plus-sign">&nbsp;</i><b><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.addNews"), ENT_NOQUOTES) ?></b></a>
</div><?php
}}

//
// block _tableNews
//
if (!function_exists($_l->blocks['_tableNews'][] = '_lbd5b5fed4a2__tableNews')) { function _lbd5b5fed4a2__tableNews($_l, $_args) { extract($_args); $_control->validateControl('tableNews')
;$_ctrl = $_control->getComponent("confirmForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
	<table class="table table-hover news">
		<thead>
			<tr>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.title"), ENT_NOQUOTES) ?></th>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.body"), ENT_NOQUOTES) ?></th>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.creationTime"), ENT_NOQUOTES) ?></th>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.createdBy"), ENT_NOQUOTES) ?></th>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.action"), ENT_NOQUOTES) ?></th>
			</tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($allNews as $news): ?>
			<tr>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($news->title, ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($template->truncate($news->body, 30), ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($template->date($news->date, 'j.n.Y H:i:s'), ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($news->users->username, ENT_NOQUOTES) ?></td>
				<td><a href="<?php echo htmlSpecialChars($_control->link("News:editNews", array($news->id))) ?>
"><i class="glyphicon glyphicon-pencil">&nbsp;</i><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.edit"), ENT_NOQUOTES) ?>
</a> | <a href="<?php echo htmlSpecialChars($_control->link("confirmForm:confirmDelete!", array('id' => $news->id, 'title' => $news->title))) ?>
"><i class="glyphicon glyphicon-trash">&nbsp;</i><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.news.delete"), ENT_NOQUOTES) ?></a></td>
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
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 