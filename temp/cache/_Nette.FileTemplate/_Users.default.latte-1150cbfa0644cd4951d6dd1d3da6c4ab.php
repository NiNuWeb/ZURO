<?php //netteCache[01]000388a:2:{s:4:"time";s:21:"0.58592600 1386698747";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\Users\default.latte";i:2;i:1386698744;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\Users\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'mmzkwhlhfz')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb843d5d4557_content')) { function _lb843d5d4557_content($_l, $_args) { extract($_args)
?><h2><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.home.manageUsers"), ENT_NOQUOTES) ?></h2>
<br />
<div class="table-responsive col-md-8">
<div id="<?php echo $_control->getSnippetId('tableUsers') ?>"><?php call_user_func(reset($_l->blocks['_tableUsers']), $_l, $template->getParameters()) ?>
</div>	<a class="btn btn-success" href="<?php echo htmlSpecialChars($_control->link("Users:addUser")) ?>
"><i class="glyphicon glyphicon-plus-sign">&nbsp;</i><b><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.user.addUser"), ENT_NOQUOTES) ?></b></a>
</div>
<?php
}}

//
// block _tableUsers
//
if (!function_exists($_l->blocks['_tableUsers'][] = '_lbb418bf2404__tableUsers')) { function _lbb418bf2404__tableUsers($_l, $_args) { extract($_args); $_control->validateControl('tableUsers')
;$_ctrl = $_control->getComponent("confirmForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
	<table class="table table-hover">
		<thead>
			<tr class="th-user">
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.user.username"), ENT_NOQUOTES) ?></th>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.user.email"), ENT_NOQUOTES) ?></th>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.user.role"), ENT_NOQUOTES) ?></th>
				<th><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.user.action"), ENT_NOQUOTES) ?></th>
			</tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($userList as $user): ?>
			<tr class="tb-user">
				<td><?php echo Nette\Templating\Helpers::escapeHtml($user->username, ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($user->email, ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($user->role, ENT_NOQUOTES) ?></td>
				<td><a href="<?php echo htmlSpecialChars($_control->link("Users:editUser", array($user->id))) ?>
"><i class="glyphicon glyphicon-pencil">&nbsp;</i><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.user.edit"), ENT_NOQUOTES) ?>
</a> | <a href="<?php echo htmlSpecialChars($_control->link("confirmForm:confirmDelete!", array('id' => $user->id, 'username' => $user->username))) ?>
"><i class="glyphicon glyphicon-trash">&nbsp;</i><?php echo Nette\Templating\Helpers::escapeHtml($template->translate("messages.admin.user.delete"), ENT_NOQUOTES) ?></a></td>
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