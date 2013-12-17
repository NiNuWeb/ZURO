<?php //netteCache[01]000388a:2:{s:4:"time";s:21:"0.50844500 1387303316";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\Pages\default.latte";i:2;i:1387303314;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\Pages\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'ms37k0m48m')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb2a702baa6a_content')) { function _lb2a702baa6a_content($_l, $_args) { extract($_args)
?><h2><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.manageMenu"), ENT_NOQUOTES) ?></h2>
<br />
<div class="table-responsive col-md-12">
<div id="<?php echo $_control->getSnippetId('tablePages') ?>"><?php call_user_func(reset($_l->blocks['_tablePages']), $_l, $template->getParameters()) ?>
</div>	<a class="btn btn-warning" href="<?php echo htmlSpecialChars($_control->link("Pages:AddPage")) ?>
"><i class="glyphicon glyphicon-plus-sign">&nbsp;</i><b><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.addPage"), ENT_NOQUOTES) ?></b></a>
</div><?php
}}

//
// block _tablePages
//
if (!function_exists($_l->blocks['_tablePages'][] = '_lb758e75ed9c__tablePages')) { function _lb758e75ed9c__tablePages($_l, $_args) { extract($_args); $_control->validateControl('tablePages')
;$_ctrl = $_control->getComponent("confirmForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
	<table class="table table-hover">
		<thead>
			<tr class="th-pages">
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.pageTitle"), ENT_NOQUOTES) ?></th>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.slug"), ENT_NOQUOTES) ?></th>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.text"), ENT_NOQUOTES) ?></th>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.position"), ENT_NOQUOTES) ?></th>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.action"), ENT_NOQUOTES) ?></th>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.translation"), ENT_NOQUOTES) ?></th>
			</tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($menu as $item): ?>
			<tr class="tb-pages">
				<td><?php echo Nette\Templating\Helpers::escapeHtml($item->title, ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($item->slug, ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($template->truncate($item->text, 50), ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($item->pages->position, ENT_NOQUOTES) ?></td>
				<td><a href="<?php echo htmlSpecialChars($_control->link("Pages:editPage", array($item->pages_id))) ?>
"><i class="glyphicon glyphicon-pencil">&nbsp;</i><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.edit"), ENT_NOQUOTES) ?>
</a> | <a href="<?php echo htmlSpecialChars($_control->link("confirmForm:confirmDelete!", array('id' => $item->pages_id, 'title' => $item->title))) ?>
"><i class="glyphicon glyphicon-trash">&nbsp;</i><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.delete"), ENT_NOQUOTES) ?></a></td>
				<td class="translated">
					<?php if ($item->pages->translated == 1): ?> <?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.translated"), ENT_NOQUOTES) ?>

					<?php else: ?> <a href="<?php echo htmlSpecialChars($_control->link("Pages:addTranslation", array($item->pages_id))) ?>
"><i class="glyphicon glyphicon-plus-sign">&nbsp;</i><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.menu.addTranslation"), ENT_NOQUOTES) ?></a>
<?php endif ?>
				</td>
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