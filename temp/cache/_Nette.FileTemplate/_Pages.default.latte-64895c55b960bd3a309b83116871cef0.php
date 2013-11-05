<?php //netteCache[01]000388a:2:{s:4:"time";s:21:"0.50148400 1383503622";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\Pages\default.latte";i:2;i:1383503620;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\Pages\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'tf5bhcp75c')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbf3f7f39fa6_content')) { function _lbf3f7f39fa6_content($_l, $_args) { extract($_args)
?><h2>Manage Main Menu</h2>
<br />
<div class="table-responsive col-md-9">
	<table class="table table-hover">
		<thead>
			<tr class="th-pages">
				<th>Page Title</th>
				<th>Slug</th>
				<th>Text</th>
				<th>Position</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($menu as $item): ?>
			<tr class="tb-pages">
				<td><?php echo Nette\Templating\Helpers::escapeHtml($item->title, ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($item->slug, ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($template->truncate($item->text, 50), ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($item->position, ENT_NOQUOTES) ?></td>
				<td><a href="<?php echo htmlSpecialChars($_control->link("Pages:editPage", array($item->id))) ?>
"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</a> | <a href="<?php echo htmlSpecialChars($_control->link("deletePage!", array($item->id))) ?>
"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</a></td>
			</tr>
<?php $iterations++; endforeach ?>
		</tbody>
	</table>
	<a class="btn btn-warning" href="<?php echo htmlSpecialChars($_control->link("Pages:AddPage")) ?>
"><i class="glyphicon glyphicon-plus-sign">&nbsp;</i><b>Add Page</b></a>
</div><?php
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